<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Restaurant extends User
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurants';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id',
        'provider',
        'CC_name',
        'CC_number',
        'CC_expiration',
        'CC_CVC',
    ];

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

}
