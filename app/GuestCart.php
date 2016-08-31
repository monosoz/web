<?php

namespace App;

use Shop;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;

class GuestCart extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = ['cart_id'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'guestcart';
    }

    /**
     * Property used to stored calculations.
     * @var array
     */
    private $cartCalculations = null;

    /**
     * One-to-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsTo("App\Cart", 'cart_id');
    }

    /**
     * One-to-Many relations with Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->hasMany('App\GuestItem', 'guestcart_id');
    }

    /**
     * Adds item to cart.
     *
     * @param mixed $item     Item to add, can be an Store Item, a Model with ShopItemTrait or an array.
     * @param int   $quantity Item quantity in cart.
     */
    public function add($item, $quantity = 1, $quantityReset = false)
    {
        if (!is_array($item) && !$item->isShoppable) return false;
        // Get item
        $cartItem = $this->getItem(is_array($item) ? $item['sku'] : $item->sku);
        // Add new or sum quantity
        if (empty($cartItem)) {
            $reflection = null;
            if (is_object($item)) {
                $reflection = new \ReflectionClass($item);
            }
            $cartItem = call_user_func( 'App\GuestItem' . '::create', [
            	'guestcart_id'  => $this->attributes['id'],
                'sku'           => is_array($item) ? $item['sku'] : $item->sku,
                'price'         => is_array($item) ? $item['price'] : $item->price,
                'tax'           => is_array($item) 
                                    ? (array_key_exists('tax', $item)
                                        ?   $item['tax']
                                        :   0
                                    ) 
                                    : (isset($item->tax) && !empty($item->tax)
                                        ?   $item->tax
                                        :   0
                                    ),
                'shipping'      => is_array($item) 
                                    ? (array_key_exists('shipping', $item)
                                        ?   $item['shipping']
                                        :   0
                                    ) 
                                    : (isset($item->shipping) && !empty($item->shipping)
                                        ?   $item->shipping
                                        :   0
                                    ),
                'currency'      => Config::get('shop.currency'),
                'quantity'      => $quantity,
                'class'         => is_array($item) ? null : $reflection->getName(),
                'reference_id'  => is_array($item) ? null : $item->shopId,
            ]);
        } else {
            $cartItem->quantity = $quantityReset 
                ? $quantity 
                : $cartItem->quantity + $quantity;
            $cartItem->save();
        }
        $this->resetCalculations();
        return $this;
    }

    /**
     * Removes an item from the cart or decreases its quantity.
     * Returns flag indicating if removal was successful.
     *
     * @param mixed $item     Item to remove, can be an Store Item, a Model with ShopItemTrait or an array.
     * @param int   $quantity Item quantity to decrease. 0 if wanted item to be removed completly.
     *
     * @return bool
     */
    public function remove($item, $quantity = 0)
    {
        // Get item
        $cartItem = $this->getItem(is_array($item) ? $item['sku'] : $item->sku);
        // Remove or decrease quantity
        if (!empty($cartItem)) {
            if (!empty($quantity)) {
                $cartItem->quantity -= $quantity;
                $cartItem->save();
                if ($cartItem->quantity > 0) return true;
            }
            $cartItem->delete();
        }
        $this->resetCalculations();
        return $this;
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name       Role name or array of role names.
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasItem($sku, $requireAll = false)
    {
        if (is_array($sku)) {
            foreach ($sku as $skuSingle) {
                $hasItem = $this->hasItem($skuSingle);

                if ($hasItem && !$requireAll) {
                    return true;
                } elseif (!$hasItem && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->items as $item) {
                if ($item->sku == $sku) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Scope class by a given user ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     * @param mixed                                 $userId User ID.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to current user cart.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereCurrent($query)
    {
        if (Auth::guest()) return $query;
        return $query->whereUser(Auth::user()->shopId);
    }

    /**
     * Scope to current user cart and returns class model.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     *
     * @return this
     */
    public function scopeCurrent($query)
    {
        if (Auth::guest()) return;
        $cart = $query->whereCurrent()->first();
        if (empty($cart)) {
            $cart = call_user_func( Config::get('shop.cart') . '::create', [
                'user_id' =>  Auth::user()->shopId
            ]);
        }
        return $cart;
    }

    /**
     * Scope to current user cart and returns class model.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  Query.
     *
     * @return this
     */
    public function scopeFindByUser($query, $userId)
    {
        if (empty($userId)) return;
        $cart = $query->whereUser($userId)->first();
        if (empty($cart)) {
            $cart = call_user_func( Config::get('shop.cart') . '::create', [
                'user_id' =>  $userId
            ]);
        }
        return $cart;
    }

    /**
     * Transforms cart into an order.
     * Returns created order.
     *
     * @param string $statusCode Order status to create order with.
     *
     * @return Order
     */
    public function placeOrder($statusCode = null)
    {
        if (empty($statusCode)) $statusCode = Config::get('shop.order_status_placement');
        // Create order
        $order = call_user_func( Config::get('shop.order') . '::create', [
            'user_id'       => $this->user_id,
            'statusCode'    => $statusCode
        ]);
        // Map cart items into order
        for ($i = count($this->items) - 1; $i >= 0; --$i) {
            // Attach to order
            $this->items[$i]->order_id  = $order->id;
            // Remove from cart
            $this->items[$i]->cart_id   = null;
            // Update
            $this->items[$i]->save();
        }
        $this->resetCalculations();
        return $order;
    }

    /**
     * Whipes put cart
     */
    public function clear()
    {
        DB::table('guestitems')
            ->where('guestcart_id', $this->attributes['id'])
            ->delete();
        $this->resetCalculations();
        return $this;
    }

    /**
     * Retrieves item from cart;
     *
     * @param string $sku SKU of item.
     *
     * @return mixed
     */
    private function getItem($sku)
    {
        $className  = 'App\GuestItem';
        $item       = new $className();
        return $item->where('sku', $sku)
            ->where('guestcart_id', $this->attributes['id'])
            ->first();
    }

    /**
     * Property used to stored calculations.
     * @var array
     */
    private $shopCalculations = null;

    /**
     * Returns total amount of items in cart.
     *
     * @return int
     */
    public function getCountAttribute()
    {
        if (empty($this->shopCalculations)) $this->runCalculations();
        return round($this->shopCalculations->itemCount, 2);
    }

    /**
     * Returns total price of all the items in cart.
     *
     * @return float
     */
    public function getTotalPriceAttribute()
    {
        if (empty($this->shopCalculations)) $this->runCalculations();
        return round($this->shopCalculations->totalPrice, 2);
    }

    /**
     * Returns total tax of all the items in cart.
     *
     * @return float
     */
    public function getTotalTaxAttribute()
    {
        if (empty($this->shopCalculations)) $this->runCalculations();
        return round($this->shopCalculations->totalTax + ($this->totalPrice * Config::get('shop.tax')), 2);
    }

    /**
     * Returns total tax of all the items in cart.
     *
     * @return float
     */
    public function getTotalShippingAttribute()
    {
        if (empty($this->shopCalculations)) $this->runCalculations();
        return round($this->shopCalculations->totalShipping, 2);
    }

    /**
     * Returns total discount amount based on all coupons applied.
     *
     * @return float
     */
    public function getTotalDiscountAttribute() { /* TODO */ }

    /**
     * Returns total amount to be charged base on total price, tax and discount.
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        if (empty($this->shopCalculations)) $this->runCalculations();
        return $this->totalPrice + $this->totalTax + $this->totalShipping;
    }

    /**
     * Returns formatted total price of all the items in cart.
     *
     * @return string
     */
    public function getDisplayTotalPriceAttribute()
    {
        return Shop::format($this->totalPrice);
    }

    /**
     * Returns formatted total tax of all the items in cart.
     *
     * @return string
     */
    public function getDisplayTotalTaxAttribute()
    {
        return Shop::format($this->totalTax);
    }

    /**
     * Returns formatted total tax of all the items in cart.
     *
     * @return string
     */
    public function getDisplayTotalShippingAttribute()
    {
        return Shop::format($this->totalShipping);
    }

    /**
     * Returns formatted total discount amount based on all coupons applied.
     *
     * @return string
     */
    public function getDisplayTotalDiscountAttribute() { /* TODO */ }

    /**
     * Returns formatted total amount to be charged base on total price, tax and discount.
     *
     * @return string
     */
    public function getDisplayTotalAttribute()
    {
        return Shop::format($this->total);
    }

    /**
     * Returns cache key used to store calculations.
     *
     * @return string.
     */
    public function getCalculationsCacheKeyAttribute()
    {
        return 'shop_' . $this->table . '_' . $this->attributes['id'] . '_calculations';
    }

    /**
     * Runs calculations.
     */
    private function runCalculations()
    {
        if (!empty($this->shopCalculations)) return $this->shopCalculations;
        $cacheKey = $this->calculationsCacheKey;
        if (Config::get('shop.cache_calculations')
            && Cache::has($cacheKey)
        ) {
            $this->shopCalculations = Cache::get($cacheKey);
            return $this->shopCalculations;
        }
        $this->shopCalculations = DB::table($this->table)
            ->select([
                DB::raw('sum(CASE WHEN guestitems.class LIKE ' . '\'%\Variant\'' . ' THEN ' . 'guestitems' . '.quantity' . ' ELSE 0 END ) as itemCount'),
                DB::raw('sum(' . 'guestitems' . '.price * ' . 'guestitems' . '.quantity) as totalPrice'),
                DB::raw('sum(' . 'guestitems' . '.tax * ' . 'guestitems' . '.quantity) as totalTax'),
                DB::raw('sum(' . 'guestitems' . '.shipping * ' . 'guestitems' . '.quantity) as totalShipping')
            ])
            ->join(
                'guestitems',
                'guestitems' . '.' . ($this->table == Config::get('shop.order_table') ? 'order_id' : $this->table . '_id'),
                '=',
                $this->table . '.id'
            )
            ->where($this->table . '.id', $this->attributes['id'])
            ->first();
        if (Config::get('shop.cache_calculations')) {
            Cache::put(
                $cacheKey,
                $this->shopCalculations,
                Config::get('shop.cache_calculations_minutes')
            );
        }
        return $this->shopCalculations;
    }

    /**
     * Resets cart calculations.
     */
    private function resetCalculations ()
    {
        $this->shopCalculations = null;
        if (Config::get('shop.cache_calculations')) {
            Cache::forget($this->calculationsCacheKey);
        }
    }

}