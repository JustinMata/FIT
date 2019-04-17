<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Restaurant extends User
{

    /**
     * Get the user that is associated with the restaurant.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the order associated with the restaurant.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the order associated with the restaurant.
     */
    public function address()
    {
        return $this->hasOne('App\Address');
    }

}
