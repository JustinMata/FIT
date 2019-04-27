<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    /**
    * Setting default base rate value from *env file
    */
    public function setBaseRateAttribute($value) {
        $this->attributes['base_rate'] = !empty($value)?$value:config('api.BASE_RATE');
    }

    /**
    * Setting default mileage rate value from *env file
    */
    public function setMileageRateAttribute($value) {
        $this->attributes['mileage_rate'] = !empty($value)?$value:config('api.MILEAGE_RATE');
    }

    /**
    * Setting default tax value from *env file
    */
    public function setTaxesAttribute($value) {
        $this->attributes['taxes'] = !empty($value)?$value:config('api.TAXES');
    }

    /**
    * Setting default trip mileage value from *env file
    */
    public function setMileageTripAttribute($value) {
        $this->attributes['mileage_trip'] = !empty($value)?$value:config('api.MILEAGE_TRIP');
    }

    /**
    * Get the restaurant that is associated with the order.
    */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    /**
    * Get the drivers associated with the order.
    */
    public function driver()
    {
        return $this->hasOne('App\Driver');
    }

    /**
    * Get the user's full name.
    *
    * @return string
    */
    public function getStatusAttribute()
    {
        $status = "";

        if(!$this->is_archived)
        {
            if(!$this->is_delivered){
                $status = 'in-progress';
            }else{
                $status = 'completed';
            }
        } else {
            if(!$this->is_delivered){
                $status = 'cancelled';
            }else{
                $status = 'archived';
            }
        }
        return $status;
    }
}
