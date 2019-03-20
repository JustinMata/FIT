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

    protected $fillable = [
        'name', 'number', 'street1', 'city', 'state', 'postal',
    ];
}
