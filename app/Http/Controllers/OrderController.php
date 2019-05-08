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
        $restaurantAddress = $this->addGoogleGeocode(Address::where('id', auth()->user()->address_id)->first());

        // Selecting driver
        $driverLocation = $this->findDriver($restaurant, $restaurantAddress);
        $driver = Driver::where('location_id', $driverLocation->id)->first();

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
        $deliveryAddress = $this->addGoogleGeocode($deliveryAddress);

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


        //  return view('driver.pages.map', ['directions' => $directions]);
        return redirect()->action('RestaurantController@show');
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

    private function findDriver($restaurant, $address)
    {
        // Grabs the addresses and calculate the distance to the restaurant address
        $addressesDistanceID = DB::table("addresses")
            ->select(
                "addresses.id",
                DB::raw("6371 * acos(cos(radians(" . $address->latitude . "))
                        * cos(radians(addresses.latitude))
                        * cos(radians(addresses.longitude) - radians(" . $address->longitude . "))
                        + sin(radians(" . $address->latitude . "))
                        * sin(radians(addresses.latitude))) AS distance")
            )
            ->groupBy(["addresses.id", "distance"])
            ->get();

        // filter out all the address that have null, 0 and are not driver addresses
        // and return the closest driver id
        $addressDistanceID = $addressesDistanceID->filter(function ($address, $key) use ($restaurant) {
            // $data = [];
            // $data['driver'] = $driver = Driver::where('location_id', '=', $address->id)->first();
            // $data['foundDriver'] = $foundDriver =  !is_null($driver) && $driver->orders()->get()->count() < 2;
            // $data['orderNumbers'] = (!is_null($driver))?$driver->orders()->get()->count(): null;
            // $data['info'] = $address;
            // dump($data);

            $driver = Driver::where('location_id', '=', $address->id)->first();

            $foundDriver = false;
            if (!is_null($driver)) {
                if ($driver->orders()->get()->count() == 0) {
                    $foundDriver = true;
                } else if ($driver->orders()->get()->count() == 1) {
                    if ($driver->orders()->where('restaurant_id', $restaurant->id)->exists()) {
                        $foundDriver = true;
                    }
                }
            }
            // $foundDriver =  !is_null($driver) && $driver->orders()->get()->count() < 2;

            return $foundDriver && !(is_null($address->distance) || (double)$address->distance == 0);
        })->sortBy('distance', SORT_NUMERIC)->first();

        // dd($addressDistanceID);
        return $addressDistanceID;
    }

    /**
     * Get lat and lng coords of newly registered user
     *
     * @param  array  $address
     * @return lat and lng coordinates
     */
    protected function addGoogleGeocode($address)
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

        return $address;
    }
}
