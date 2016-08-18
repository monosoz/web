<?php

namespace App\Http\Controllers;

use Auth;

Use Shop;

use Illuminate\Http\Request;

use App\Http\Requests\AddToCart;

use App\Http\Requests\Coupon;

use App\Product;

use App\Variant;

use App\Addon;

use App\Item;

use App\ItemRelation;

use App\GuestItemRelation;

use App\Tag;

use App\Cart;

use App\GuestItem;

use App\GuestCart;

use App\User;

use Cookie;

use Session;

class PagesController extends Controller
{
	public function __construct()
    {

        
        if (Auth::check()) {
            $this->cart = Cart::current();
        } else {
            if (session()->has('cartId')&GuestCart::find(session('cartId'))!=null) {
                $this->cart = GuestCart::find(session('cartId'));
            } else {
                $this->cart = GuestCart::create();
                session(['cartId' => $this->cart->id]);
            }
        }
    }

    public function index()
    {

        $cs = Cookie::get('cartStatus');
        $ws = Cookie::get('welcomeStatus');
        Cookie::queue('cartStatus', 0);
        Cookie::queue('welcomeStatus', $ws+1);
        return view('main', ['tags' => Tag::all(), 'cart' => $this->cart, 'cart_status' => $cs, 'ws' => $ws,]);
    }

    public function cart(Request $request)
    {

        $this->cart->add(Variant::findOrFail($request->get('id')));

        return redirect()->back();
    }
    public function add_custom(AddToCart $request)
    {

        if ($request->p_id==0) {
            if($request->sz==='r'){
                $this->cart->add(['sku' => 'PROD0002R', 'price' => 100]);
                    $this->custom_sku='PROD0002R';//$var->sku;
            }
            elseif($request->sz==='m'){
                $this->cart->add(['sku' => 'PROD0003M', 'price' => 150]);
                    $this->custom_sku='PROD0003M';//$var->sku;
            }
            elseif($request->sz==='l'){
                $this->cart->add(['sku' => 'PROD0004L', 'price' => 200]);
                    $this->custom_sku='PROD0004L';//$var->sku;
            }

        } else {

            foreach (Product::find($request->p_id)->variants as $var) {
                if ($var->type==$request->sz) {
                    $this->cart->add($var);
                    $this->custom_sku=$var->sku;
                }
            }
        }
        foreach ($this->cart->items as $item) {
            if ($item->sku==$this->custom_sku) {
                $this->custom_item=$item;
            }
        }
        if ($request->top_id!=null) {
            foreach ($request->top_id as $addon) {
                $this->cart->add(Addon::findOrFail($addon));
                if (Auth::guest()) {
                    $itemr=GuestItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $addon,]);
                } else {
                    $itemr=ItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $addon,]);
                }
                    $itemr->save();
                
                
            }
        }
        return redirect()->back();
    }

    public function item(Request $request, $item)
    {
        if ( $request->get('action') == 'rm' ) {
            $this->cart->remove(['sku' => $item], 1);
        } elseif ( $request->get('action') == 'add' ) {
            $this->cart->add(['sku' => $item]);
        }
        Cookie::queue('cartStatus', 1);
        return redirect()->back();
    }

    public function clearcart(Request $request)
    {
        if ( $request->get('action') == 'clear' ) {
            $this->cart->clear();
        }
        Cookie::queue('cartStatus', 1);
        return redirect()->back();
    }

    public function applycoupon(Request $request)
    {
        Cookie::queue('cartStatus', 1);
        $this->validate($request, [
            'code' => 'required|exists:coupons,code',
        ]);
        $ifc=Item::where('sku', '=', $request->get('code'))->first();
        if ($this->cart->items->where('price', '229.00')->count()==0) {
            Session::flash('couponMessage', 'Coupon not applicable.');
        }
        elseif ( $ifc==null||$ifc->order_id==null) {
            Item::where('sku', '=', $request->get('code'))->where('order_id', '=', null)->delete();
            GuestItem::where('sku', '=', $request->get('code'))->delete();
            Item::where('sku', '=', 'OFF1006818')->where('order_id', '=', null)->delete();
            GuestItem::where('sku', '=', 'OFF1006818')->delete();
            foreach ($this->cart->items->where('price', '229.00') as $custom_item) {
                ItemRelation::where('parent_id', '=', $custom_item->id)->where('child_id', '=', '101')->delete();
                GuestItemRelation::where('parent_id', '=', $custom_item->id)->where('child_id', '=', '101')->delete();
            }
            if ($request->get('code')=='OFF100') {
                if (Auth::guest()) {
                    $itno=1;
                    foreach ($this->cart->items->where('price', '229.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                        $this->cart->add(Addon::findOrFail(101));
                        $itemr=GuestItemRelation::create(['parent_id'=> $custom_item->id, 'item_no'=> $itno,'child_id' => 101,]);
                        }
                    }
                } else {
                    $itno=1;
                    foreach ($this->cart->items->where('price', '229.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                        $this->cart->add(Addon::findOrFail(101));
                        $itemr=ItemRelation::create(['parent_id'=> $custom_item->id, 'item_no'=> $itno,'child_id' => 101,]);
                        }
                    }
                }
            } else {
                $this->cart->add(['sku' => $request->get('code'), 'price' => -229]);
            }
            
        }
        else{
            Session::flash('couponMessage', 'Coupon already used.');
        }
        return redirect()->back();
    }

}
