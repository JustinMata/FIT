<?php

namespace App\Http\Controllers;

use App\Order;
use App\Address;

use Illuminate\Http\Request;

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
        $origin = "345+E+William+St,CA";
        $destination = str_replace(" ", "+", request('street1'));
        $destination .= "," . str_replace(" ", "+", request('city'));

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&key=AIzaSyB2i3tIi6Yn9DOzeUQJf3DUcFbFh9IOcOY";

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
        }


        //create a new order
        $order = new Order();

        $order->setBaseRateAttribute(null);
        $order->setMileageRateAttribute(null);

        //calculate delivery price
        $deliveryPrice = env('BASE_RATE') + env('MILEAGE_RATE') * $dist;
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
        return redirect('/cart');
    }
}
