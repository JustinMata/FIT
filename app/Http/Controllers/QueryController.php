<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class QueryController extends Controller
{

    public function index()
    {
        
        
        $restaurants = DB::select(DB::raw ("SELECT CC_name, orders.is_archived, orders.is_delivered, CC_number, provider, users.id, users.address_id , delivery_price , taxes, delivery_name,
        delivery_comments, email, phone_number,name, number, street1, city, state, postal, driver_id, mileage_trip
        FROM restaurants, orders, drivers, addresses , users
        WHERE orders.id = addresses.id AND orders.id = restaurants.id AND orders.id = users.id AND  orders.id = drivers.id AND users.address_id" ));
        
        $orders = DB::select ( DB::raw ("SELECT delivery_name, mileage_trip, name, number, orders.created_at,
        street1, city, state, postal, CC_name, delivery_price, taxes, restaurant_id, license_plate, phone_number  FROM addresses, orders, restaurants, users, drivers
          WHERE orders.id = addresses.id AND orders.id = restaurants.id AND orders.id = users.id AND orders.id = drivers.id" )); 
        $drivers = DB::select( DB::raw("SELECT delivery_name, driver_id, license_plate, account_routing, first_name, 
        last_name, email, phone_number, CC_name, base_rate, mileage_rate FROM orders,drivers, restaurants, users WHERE orders.id = drivers.id AND orders.id = restaurants.id
         AND drivers.id = users.id " ));
         // query information for drivers.
        echo"---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"."<br>";
        echo " let's print some information about drivers"."<br>";
        echo"Restaurant_name-> delivery_name->first_name->last_name->phone_number->driver_id->license_plate->base_rate->mileage_rate->account_routing."."<br>";
          foreach($drivers as $result) {
            echo $result ->CC_name."->";
            echo $result ->delivery_name."->";
            echo $result->first_name."->";
            echo $result->last_name."->";
            echo $result->phone_number."->";
            echo $result ->driver_id."->";
            echo $result ->license_plate."->";
            echo $result->base_rate."->";
            echo $result->mileage_rate."->";
            echo $result ->account_routing."<br>";
                        }          
        // query information for $order
        echo"---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"."<br>";
        echo " let's print some information about orders"."<br>";
        echo"Restaurant_name->restaurant_id->delivery_name->license_plate->phone_number->order_name->
        order_number->mileage_trip->customer_address->order_created "."<br>";
        foreach ($orders as $order) {
            echo $order->CC_name."->";
            echo $order->restaurant_id."->";
            echo $order->delivery_name."->";  
            echo $order->license_plate."->";
            echo $order->phone_number."->";
            echo $order->name."->";
            echo $order->number."->";               
            echo $order->mileage_trip."->";
            echo $order->street1.",";
            echo $order->city.",";
            echo $order->state.",";
            echo $order->postal."->";
            echo $order->delivery_price."->";
            echo $order->taxes."->";
            echo $order->created_at."<br>";         
         }
         // query information for $restaurant
        echo"---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"."<br>";
        echo " let's print some information about orders"."<br>";
        echo"Restaurant_name->restaurant_number->provider->driver_id->delivery_price->taxes->
        delivery_name->comment->ID (for order)-> driver_email-> driver_phone_number-> mileage_trip->customer_address"."<br>";
        foreach ($restaurants as $restaurant) {
            echo $restaurant->CC_name."->";
            echo $restaurant->CC_number."->";
            echo $restaurant->provider."->";
            echo $restaurant->driver_id."->";
            echo $restaurant->delivery_price."->";
            echo $restaurant->taxes."->";
            echo $restaurant->delivery_name."->";
            echo $restaurant->delivery_comments."->";
            echo $restaurant->id."->";
            echo $restaurant->address_id."->";
            echo $restaurant->email."->";
            echo $restaurant->phone_number."->";          
            echo $restaurant->mileage_trip."->";
            echo $restaurant->street1.",";
            echo $restaurant->city.",";
            echo $restaurant->state.",";
            echo $restaurant->postal."<br>";

            
           }
        }

    
}
