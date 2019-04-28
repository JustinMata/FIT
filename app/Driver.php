<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Driver extends User
{
    // use HasRoles;

    protected $guard_name = [];

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
        return $this->hasOne('App\Address');
    }

    /**
     * Get the drivers associated with the order.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    // /**
    // * Get the user's full name.
    // *
    // * @return string
    // */
    // public function getFullNameAttribute()
    // {
    //     // dd($this);
    //     // $user = User::where('id', $this->user_id )->first();
    //     return $user->user()->first()->full_name;
    // }

}
