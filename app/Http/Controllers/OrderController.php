<?php

namespace App\Http\Controllers;

use App\Order;
use App\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function make()
    {
        return view('pages.orderForm');
    }

    public function store()
    {

        //create a new address for the customer
        $address_id = \App\Address::count() + 1;

        $address = new Address();

        $address->name = request('delivery_name');
        $address->number = 0;
        $address->street1 = request('street1');
        if (!empty(request('street2'))) $address->street2 = request('street2');
        $address->city = request('city');
        $address->state = request('state');
        $address->postal = request('zip');

        $address->save();

        //@TODO: USE GOOGLE API WRAPPER
        //use google api to calculate wait time and mileage
        $driverLocation = "345+E+William+St,CA";
        $restaurantLocation = "140+E+San+Carlos+St,CA";

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$driverLocation&destinations=$restaurantLocation&key=AIzaSyB2i3tIi6Yn9DOzeUQJf3DUcFbFh9IOcOY";

        //fetch json response from googleapis.com:
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        //If google responds with a status of OK
        //Extract the distance text:
        if ($response['status'] == "OK") {
            $dist = $response['rows'][0]['elements'][0]['distance']['text'];
            $dist = (double)str_replace(" mi", "", $dist);
            $time = $response['rows'][0]['elements'][0]['duration']['text'];
            $time = explode(" ", $time);
        }


        //@TODO: USE GOOGLE API WRAPPER
        //use google api to calculate wait time and mileage
        $destination = str_replace(" ", "+", request('street1'));
        $destination .= "," . str_replace(" ", "+", request('city'));

        $url2 = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$restaurantLocation&destinations=$destination&key=AIzaSyB2i3tIi6Yn9DOzeUQJf3DUcFbFh9IOcOY";

        //fetch json response from googleapis.com:
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        $response2 = json_decode(curl_exec($ch2), true);

        //If google responds with a status of OK
        //Extract the distance text:
        if ($response2['status'] == "OK") {
            $dist2 = $response2['rows'][0]['elements'][0]['distance']['text'];
            $dist2 = (double)str_replace(" mi", "", $dist2);
            $dist += $dist2;
            $time2 = $response2['rows'][0]['elements'][0]['duration']['text'];
            $time2 = explode(" ", $time2);
        }

        $waitTime = 0;
        if (sizeof($time) > 2) {
            $waitTime = ($time[0] * 60) + $time[2];
        } else {
            $waitTime = $time[0];
        }

        if (sizeof($time2) > 2) {
            $waitTime += ($time2[0] * 60) + $time2[2];
        } else {
            $waitTime += $time2[0];
        }

        if ($waitTime > 30) {
            //do something
        }

        //create a new order
        $order = new Order();

        $order->setBaseRateAttribute(null);
        $order->setMileageRateAttribute(null);

        //calculate delivery price
        if ($dist > 1) $deliveryPrice = env('BASE_RATE') + env('MILEAGE_RATE') * ($dist - 1);
        else $deliveryPrice = env('BASE_RATE');

        $deliveryPrice += $deliveryPrice * (env('TAXES') / 100);
        $order->delivery_price = $deliveryPrice;

        $order->setTaxesAttribute(null);
        $order->mileage_trip = $dist;
        $order->delivery_name = request('delivery_name');
        if (!empty(request('delivery_comments'))) $order->delivery_comments = request('delivery_comments');
        $order->is_delivered = false;
        $order->restaurant_id = 1;
        $order->driver_id = 1;
        $order->address_id = $address_id;
        $order->is_archived = false;
        $order->is_payed = false;

        $order->save();

        //redirects to the cart view which still needs to be created. For now it just displays 'order created' if successful
        $destination = request('street1') . "," . request('state');
        return view('pages.directions', compact('destination'));
    }
}
