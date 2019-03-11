<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderArchive extends Order
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders_archive';

}
