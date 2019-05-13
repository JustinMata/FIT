<?php

namespace App\Http\Controllers;

use DB;
use App\Address;
use App\Driver;
use App\Order;
use App\Restaurant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function make()
    {
        if (auth()->check() && (auth()->user()->hasRole('admin'))) {
            return redirect()->back();
        }

        if (Auth::user()->hasRole('restaurant') && request()->is('restaurant*')) {
            return view('restaurant.pages.orderForm');
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        // Getting restaurant info
        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        $restaurantAddress =  Address::where('id', auth()->user()->address_id)->first();

        // Adding long lat to address
        $this->addGoogleGeocode($restaurantAddress);

        // dump($restaurantAddress);

        // creating delivery address
        $deliveryAddress = Address::create([
            'name' => $request->input('delivery_name'),
            'street1' => $request->input('street1'),
            'street2' => $request->input('street2'),
            'city' => $request->input('city'),
            'postal' => $request->input('zip'),
            'state' => $request->input('state'),
            'latitude' => 0,
            'longitude' => 0
        ]);

        // getting coordinates for new deliver order
        $this->addGoogleGeocode($deliveryAddress);

        // dump($deliveryAddress);

        // Selecting driver
        $driverLocation = $this->findDriver($restaurant, $restaurantAddress, $deliveryAddress);

        // dd($driverLocation);

        if (!is_null($driverLocation)) {



            $driver = Driver::where('location_id', $driverLocation->id)->first();

            // first mile is always free, so taking that into account
            $distance = $driverLocation->distance;
            if ($distance > 1) $distance -= 1;
            else $distance = 0;

            // price without taxes
            $price = ($distance * config('api.MILEAGE_RATE')) + config('api.BASE_RATE');

            // taxes
            $taxes = $price * (config('api.TAXES') * .01);

            //creating order
            $order = Order::create([
                'base_rate' => config('api.BASE_RATE'),
                'mileage_rate' => config('api.MILEAGE_RATE'),
                'delivery_price' => $price + $taxes,
                'taxes' => config('api.TAXES'),
                'mileage_trip' => number_format($driverLocation->distance, 2),
                'delivery_name' => $request->input('delivery_name'),
                'delivery_comments' => $request->input('delivery_comments'),
                'is_delivered' => false,
                'restaurant_id' => $restaurant->id,
                'driver_id' => $driver->id,
                'address_id' => $deliveryAddress->id,
                'is_archived' => false,
                'is_payed' => true,
            ]);
            return redirect()->action('RestaurantController@show');
        }

        return redirect()->action('RestaurantController@show')->withErrors(['driverNotFound' => 'We could not find a driver to complete the delivery!']);
    }

    public function cancel(Request $request)
    {
        $order = Order::where('id', $request->input('order-id'))->first();

        $this->archiveOrder($order);

        if (request()->is('restaurant*')) {
            return redirect()->action('RestaurantController@show');
        } else if (request()->is('driver*')) {
            return redirect()->action('DriverController@show');
        }

        return redirect('/');
    }

    public function archive(Request $request)
    {
        $order = Order::where('id', $request->input('order-id'))->first();

        $order->is_delivered = true;
        $order->save();

        $this->archiveOrder($order);

        return redirect()->action('RestaurantController@show');
    }

    public function archiveOrder(Order $order)
    {
        $order->is_archived = true;
        $order->save();

        $archivedOrder = \App\OrderArchive::create([
            'base_rate' => $order->base_rate,
            'mileage_rate' => $order->mileage_rate,
            'delivery_price' => $order->delivery_price,
            'taxes' => $order->taxes,
            'mileage_trip' => $order->mileage_trip,
            'delivery_name' => $order->delivery_name,
            'delivery_comments' => $order->delivery_comments,
            'is_delivered' => $order->is_delivered,
            'restaurant_id' => $order->restaurant_id,
            'driver_id' => $order->driver_id,
            'address_id' => $order->address_id,
            'is_archived' => true,
            'is_payed' => $order->is_payed,
        ]);

        $archivedOrder->save();
    }

    public function delete(Request $request)
    {
        $order = Order::where('id', $request->input('order-id'))->first();

        $order->delete();

        return redirect()->action('RestaurantController@show');
    }

    private function findDriver($restaurant, $restaurantAddress, $deliveryAddress)
    {
        // Grabs the addresses that correspond to driver addresses, calculate the distance and gives
        // results that are ordered by distance, filters out nulls and 0.0 distances.
        $addressesDistanceID = DB::table("addresses")
            ->join('drivers', 'drivers.location_id', '=', 'addresses.id')
            ->select(
                "addresses.id",
                DB::raw("6371 * acos(cos(radians(" . $restaurantAddress->latitude . "))
                        * cos(radians(addresses.latitude))
                        * cos(radians(addresses.longitude) - radians(" . $restaurantAddress->longitude . "))
                        + sin(radians(" . $restaurantAddress->latitude . "))
                        * sin(radians(addresses.latitude))) AS distance")
            )
            ->groupBy(["addresses.id", "distance"])
            ->orderBy("distance")
            ->get()->filter(function ($value) {
                return !($value->distance == null || $value->distance == 0);
            });


        $destinations = [];
        data_fill($destinations, 'restaurant', $restaurantAddress->google_formatted_address);
        data_fill($destinations, "delivery.0", $deliveryAddress->google_formatted_address);

        // making class static methods available
        $class = __CLASS__;

        // filter out all the address that have null, 0 and are not driver addresses
        // and return the closest driver id
        $addressDistanceID = $addressesDistanceID->filter(function ($address, $key) use ($restaurant, &$destinations, $class) {

            $foundDriver = false;

            // Getting driver associated with location
            $driver = Driver::where('location_id', '=', $address->id)->where('is_available', true)->first();

            // If driver exists
            if (!is_null($driver)) {

                data_fill($destinations, 'driver', $driver->location()->first()->google_formatted_address);
                // Getting driver order count
                $orderCount = $driver->orders()->get()->count();

                // if driver already has 2 orders skip
                if($orderCount < 2){

                    // if 0 order found river
                    if ($orderCount == 0) {
                        // print_r("has no orders($key):");
                        // dump($destinations);
                        $foundDriver = true;
                    // if already has order make sure it's from same restaurant
                    } else if ($orderCount == 1) {

                        // Getting existing driver order
                        $firstOrder = $driver->orders()->where([
                            ['restaurant_id', '=', $restaurant->id],
                            ['is_archived', '=', false]
                            ])->first();

                        // Checking if order exists
                        if (!is_null($firstOrder)) {

                            // making sure we get the right array index
                            $index = count($destinations['delivery']);

                            // Adding order destination to array
                            data_fill($destinations, "delivery.$index", $firstOrder->address()->first()->google_formatted_address);

                            $foundDriver = true;
                        }
                    }

                    $directions = '';

                    // if we have a driver, we calculate best route and timing
                    if($foundDriver){

                        if(count($destinations['delivery']) == 1)
                        {
                            $directions = \GoogleMaps::load('directions')->setParam([
                                'origin' => $destinations['delivery'],
                                'waypoints' => [$destinations['restaurant']],
                                'optimizeWaypoints' => false,
                                'destination' => $destinations['delivery'][0],
                                'departure_time' => 'now'
                            ])->get();

                        } else if(count($destinations['delivery']) == 2) {

                            $directions = \GoogleMaps::load('directions')->setParam([
                                'origin' => $destinations['driver'],
                                'waypoints' => [$destinations['restaurant'], $destinations['delivery'][1]],
                                'optimizeWaypoints' => false,
                                'destination' => $destinations['delivery'][0],
                                'departure_time' => 'now'
                            ])->get();
                        }

                        $duration = $class::totalDuration(json_decode($directions));

                        if($duration > 1800)
                        {
                            $foundDriver = false;
                        }
                    }
                }
            }

            return $foundDriver;

        })->sortBy('distance', SORT_NUMERIC)->first();

        return $addressDistanceID;
    }

    protected function getDirections($driver, $restaurant, $firstDestination, $secondDestination = null)
    {
        $directions =  \GoogleMaps::load('directions')->setParam([
            'origin' => $driver,
            'waypoints' => [$restaurant, $secondDestination],
            'optimizeWaypoints' => false,
            'destination' => $firstDestination,
            'departure_time' => 'now'
        ])->get();


        // dd($directions);
        return json_decode($directions);
    }

    /**
     * Get lat and lng coords of newly registered user
     *
     * @param  array  $address
     * @return lat and lng coordinates
     */
    protected function addGoogleGeocode(&$address)
    {
        $geocode = \GoogleMaps::load('geocoding')
            ->setParam(['address' => $address->google_formatted_address])
            ->get();

        $response = json_decode($geocode);

        if ($response->status == 'OK') {
            $address->latitude = $response->results[0]->geometry->location->lat;
            $address->longitude = $response->results[0]->geometry->location->lng;
            $address->save();
        }

        // return $address;
    }

    /**
     * Get lat and lng coords of newly registered user
     *
     * @param  array  $address
     * @return lat and lng coordinates
     */
    public static function totalDuration($direction) {
        $durations = [];

        if ($direction->status == 'OK') {
            $durations = data_get($direction, 'routes.*.legs.*.duration.value');
        }

        return array_sum($durations);
    }
}
