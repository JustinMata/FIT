<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'first_name',
         'last_name',
         'email',
         'password',
         'phone_number',
         'type',
         'address_id'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the driver associated with the user.
     */
    public function driver()
    {
        return $this->hasOne('App\Driver');
    }

    /**
     * Get the restaurant associated with the user.
     */
    public function restaurant()
    {
        return $this->hasOne('App\Restaurant');
    }

    /**
     * Get the drivers associated with the order.
     */
    public function location()
    {
        // return $this->hasMany('App\Address', 'id', 'location_id');
        return $this->hasManyThrough('App\Address', 'App\Driver');
    }

    /**
     * Get the drivers associated with the order.
     */
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

     /**
     * Get the drivers associated with the order.
     */
    public function orders()
    {
        if($this->hasRole('driver')){
            return $this->hasManyThrough('App\Address', 'App\Driver');
        }

        if ($this->hasRole('restaurant')) {
            return $this->hasManyThrough('App\Address', 'App\Restaurant');
        }
    }

    /**
    * Get the user's full name.
    *
    * @return string
    */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // public function hasRole($role)
    // {
    //     return User::where('id', $this->id)->value('type') == strtoupper($role);
    // }
}
