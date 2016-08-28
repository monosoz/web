<?php

namespace App;

/**
 * This file is part of LaravelShop,
 * A shop solution for Laravel.
 *
 * @author Alejandro Mostajo
 * @copyright Amsgames, LLC
 * @license MIT
 * @package Amsgames\LaravelShop
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class GuestItem extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Name of the route to generate the item url.
     *
     * @var string
     */
    protected $itemRouteName = '';

    /**
     * Name of the attributes to be included in the route params.
     *
     * @var string
     */
    protected $itemRouteParams = [];

    /**
     * Name of the attributes to be included in the route params.
     *
     * @var string
     */
    protected $fillable = ['guestcart_id', 'sku', 'price', 'tax', 'shipping', 'currency', 'quantity', 'class', 'reference_id'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'guestitems';
    }
    
    public function rel()
    {
        return $this->hasMany("App\GuestItemRelation", 'parent_id');
    }

    /**
     * One-to-One relations with the cart model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsTo('App\GuestCart', 'guestcart_id');
    }

    /**
     * Returns flag indicating if item has an object.
     *
     * @return bool
     */
    public function getHasObjectAttribute() 
    {
        return array_key_exists('class', $this->attributes) && !empty($this->attributes['class']);
    }

    /**
     * Returns flag indicating if the object is shoppable or not.
     *
     * @return bool
     */
    public function getIsShoppableAttribute()
    {
        return true;
    }

    /**
     * Returns attached object.
     *
     * @return mixed
     */
    public function getObjectAttribute()
    {
        return $this->hasObject ? call_user_func($this->attributes['class'] . '::find', $this->attributes['reference_id']) : null;
    }

    /**
     * Returns item name.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        if ($this->hasObject) return $this->object->displayName;
        return isset($this->itemName)
            ? $this->attributes[$this->itemName]
            : (array_key_exists('name', $this->attributes)
                ? $this->attributes['name']
                : ''
            );
    }

    /**
     * Returns item id.
     *
     * @return mixed
     */
    public function getShopIdAttribute()
    {
        return is_array($this->primaryKey) ? 0 : $this->attributes[$this->primaryKey];
    }

    /**
     * Returns item url.
     *
     * @return string
     */
    public function getShopUrlAttribute()
    {
        if ($this->hasObject) return $this->object->shopUrl;
        if (!property_exists($this, 'itemRouteName') && !property_exists($this, 'itemRouteParams')) return '#';
        $params = [];
        foreach (array_keys($this->attributes) as $attribute) {
            if (in_array($attribute, $this->itemRouteParams)) $params[$attribute] = $this->attributes[$attribute];
        }
        return empty($this->itemRouteName) ? '#' : \route($this->itemRouteName, $params);
    }

    /**
     * Returns price formatted for display.
     *
     * @return string
     */
    public function getDisplayPriceAttribute()
    {
        return Shop::format($this->attributes['price']);
    }

    /**
     * Scope class by a given sku.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     * @param mixed                                 $sku    SKU.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereSKU($query, $sku)
    {
        return $query->where('sku', $sku);
    }

    /**
     * Scope class by a given sku.
     * Returns item found.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     * @param mixed                                 $sku    SKU.
     *
     * @return this
     */
    public function scopeFindBySKU($query, $sku)
    {
        return $query->whereSKU($sku)->first();
    }

    /**
     * Returns formatted tax for display.
     *
     * @return string
     */
    public function getDisplayTaxAttribute()
    {
        return Shop::format(array_key_exists('tax', $this->attributes) ? $this->attributes['tax'] : 0.00);
    }

    /**
     * Returns formatted tax for display.
     *
     * @return string
     */
    public function getDisplayShippingAttribute()
    {
        return Shop::format(array_key_exists('shipping', $this->attributes) ? $this->attributes['shipping'] : 0.00);
    }

    /**
     * Returns flag indicating if item was purchased by user.
     *
     * @return bool
     */
    public function getWasPurchasedAttribute()
    {
        if (Auth::guest()) return false;
        return Auth::user()
            ->orders()
            ->whereSKU($this->attributes['sku'])
            ->whereStatusIn(config('shop.order_status_purchase'))
            ->count() > 0;
    }

}