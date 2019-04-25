<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    protected $fillable = [
        'name', 'number', 'street1', 'city', 'state', 'postal'
    ];

    /**
     * Get the user that is associated with the restaurant.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user that is associated with the restaurant.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get the user that is associated with the restaurant.
     */
    public function driver()
    {
        return $this->belongsTo('App\Driver', 'location_id', 'id');
    }

    /**
     * Get the user that is associated with the restaurant.
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant', 'location_id', 'id');
    }

    /**
    * Format address for google api wrapper.
    *
    * @return string
    */
    public function getGoogleFormattedAddressAttribute()
    {
        return "{$this->street1}+{$this->street2}+{$this->city}+{$this->postal}";
    }

    /**
    * Format longitude latitude for google api wrapper
    *
    * @return string
    */
    public function getGoogleGeocodeAddressAttribute()
    {
        return "{$this->latitude},{$this->longitude}";
    }

}
