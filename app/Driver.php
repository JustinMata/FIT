<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Driver extends User
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

    protected $fillable = [
        'account_number', 'account_routing', 'car', 'license_plate', 'license_number', 'license_expiration', 'insurance_number',
    ];
}
