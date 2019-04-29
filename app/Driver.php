<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Driver extends User
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drivers';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id',
        'location_id',
        'account_number',
        'account_routing',
        'is_available',
        'car',
        'license_plate',
        'license_number',
        'license_expiration',
        'insurance_number',
    ];

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
    public function location()
    {
        // return $this->hasMany('App\Address', 'id', 'location_id');
        return $this->hasOne('App\Address', 'id', 'location_id');
    }

    /**
     * Get the drivers associated with the order.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
