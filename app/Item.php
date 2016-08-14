<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopItemModel;

class Item extends ShopItemModel
{

    public function item()
    {
        return $this->belongsTo("App\Item", 'item_id');
    }

    /**
     * One-to-Many relations with Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->hasMany('App\Item', 'item_id');
    }
}
