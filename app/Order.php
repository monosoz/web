<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function location()
    {
        return $this->hasOne('App\Location');
    }
}
