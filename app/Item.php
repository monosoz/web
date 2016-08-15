<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;

class Item extends ShopItemModel
{

    public function rel()
    {
        return $this->hasMany("App\ItemRelation", 'parent_id');
    }

}
