<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Amsgames\LaravelShop\Traits\ShopItemTrait;

class Addon extends Model
{
    use ShopItemTrait;

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
