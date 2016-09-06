<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\StatusCode', 'statusCode');
    }

    public function delivery_location()
    {
        return $this->hasOne('App\DeliveryLocation');
    }

    public function feedbacks()
    {
        return $this->hasOne('App\Feedback');
    }
}
