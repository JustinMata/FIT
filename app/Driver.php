<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * Get the user that is associated with the driver.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the drivers associated with the order.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
