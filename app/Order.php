<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{

    protected $fillable = [
        'statusCode',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
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
