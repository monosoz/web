<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{

    public function user()
    {
        return $this->belongsTo('App\Order');
    }

    public $timestamps = false;
    
}
