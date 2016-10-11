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

    public function index(Request $request)
    {
            $csd = 0;
            if (!config('shop.open')) {
                $csd=0;
            }

            if (session()->has('cartStatus')) {
                $this->cs = session('cartStatus');
                session(['cartStatus' => $csd]);
            } else {
                session(['cartStatus' => $csd]);
                $this->cs = $csd;
            }
            if ($request->r=='fb') {
                session(['cartStatus' => 0]);
                return redirect('/');
            }elseif ($request->r=='off100') {
                session(['cartStatus' => 5]);
                return redirect('/');
            }elseif ($request->r=='ga1' || $request->r=='ga2') {
                session(['cartStatus' => 5]);
                return redirect('/');
            }

            
        return view('main', ['tags' => Tag::all(), 'cart' => $this->cart, 'cart_status' => $this->cs,]);
    }

    public function cart(Request $request)
    {

        $this->cart->add(Variant::findOrFail($request->get('id')));

        session(['cartStatus' => 2]);
        return redirect()->back();
    }
    public function add_custom(AddToCart $request)
    {

        if ($request->p_id==0) {
            if($request->sz==='r'){
                $this->cart->add(['sku' => 'PROD0002R', 'price' => 100, 'tax' => 12.5]);
                    $this->custom_sku='PROD0002R';//$var->sku;
            }
            elseif($request->sz==='m'){
                $this->cart->add(['sku' => 'PROD0003M', 'price' => 150, 'tax' => 18.75]);
                    $this->custom_sku='PROD0003M';//$var->sku;
            }
            elseif($request->sz==='l'){
                $this->cart->add(['sku' => 'PROD0004L', 'price' => 200, 'tax' => 25]);
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
                $this->cart->add(Addon::findOrFail($request->base_id));
                if (Auth::guest()) {
                    $itemr=GuestItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $request->base_id,]);
                } else {
                    $itemr=ItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $request->base_id,]);
                }
        if ($request->top_id!=null) {
            foreach ($request->top_id as $addon) {
                $this->cart->add(Addon::findOrFail($addon));
                if (Auth::guest()) {
                    $itemr=GuestItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $addon,]);
                } else {
                    $itemr=ItemRelation::create(['parent_id'=> $this->custom_item->id, 'item_no'=> $this->custom_item->quantity,'child_id' => $addon,]);
                }
            }
        }
        session(['cartStatus' => 2]);
        return redirect()->back();
    }

    public function item(Request $request, $item)
    {
        if ( $request->get('action') == 'rm' ) {
            $this->cart->remove(['sku' => $item], 1);
        } elseif ( $request->get('action') == 'add' ) {
            $this->cart->add(['sku' => $item]);
        }
        session(['cartStatus' => 1]);
        return redirect()->back();
    }

    public function clearcart(Request $request)
    {
        if ( $request->get('action') == 'clear' ) {
            $this->cart->clear();
        }
        session(['cartStatus' => 1]);
        return redirect()->back();
    }

    public function applycoupon(Request $request)
    {
        session(['cartStatus' => 1]);
        $this->validate($request, [
            'code' => 'required|exists:coupons,code',
        ]);
        $reqcode=strtoupper($request->get('code'));
        $ifc=Item::where('sku', '=', $reqcode)->first();
        if ($this->cart->count==0) {
            Session::flash('couponMessage', 'Coupon not applicable.');
        }
        elseif ( $ifc==null||$ifc->order_id==null) {
            Item::where('sku', '=', $reqcode)->where('order_id', '=', null)->delete();
            GuestItem::where('sku', '=', $reqcode)->delete();
            Item::where('price', '<', 0)->where('cart_id', '=', $this->cart->id)->delete();
            GuestItem::where('price', '<', 0)->where('guestcart_id', '=', $this->cart->id)->delete();
            foreach ($this->cart->items->where('price', '229.00') as $custom_item) {
                ItemRelation::where('parent_id', '=', $custom_item->id)->where('child_id', '=', '101')->delete();
                GuestItemRelation::where('parent_id', '=', $custom_item->id)->where('child_id', '=', '101')->delete();
            }
            $applicable = false;
            if ($reqcode=='OFF100') {
                if (true) {
                    Session::flash('couponMessage', 'Coupon expired.');
                            $applicable = true;
                } else {
                    foreach ($this->cart->items->where('price', '229.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                            $this->cart->add(['sku' => 'OFF1006818', 'price' => -100]);
                            $applicable = true;
                        }
                    }
                    foreach ($this->cart->items->where('price', '269.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                            $this->cart->add(['sku' => 'OFF1006818', 'price' => -100]);
                            $applicable = true;
                        }
                    }
                }
            } elseif ($reqcode=='OFF50') {
                if (true) {
                    Session::flash('couponMessage', 'Coupon expired.');
                            $applicable = true;
                } elseif ($this->cart->total > 99) {
                    $this->cart->add(['sku' => 'OFF506917', 'price' => -50]);
                    $applicable = true;
                } else {
                    # code...
                }
                
            } elseif ($reqcode=='OFF25') {
                if (true) {
                    Session::flash('couponMessage', 'Coupon expired.');
                            $applicable = true;
                } elseif ($this->cart->total > 99) {
                    $disc25 = 0.00;
                    if (Auth::check()) {
                        foreach (Item::where('cart_id', '=', $this->cart->id)->where('tax', '>', 0)->get() as $custom_item) {
                            for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                                $disc25 += $custom_item->price * 0.25;
                            }
                        }
                    } else {
                        foreach (GuestItem::where('guestcart_id', '=', $this->cart->id)->where('tax', '>', 0)->get() as $custom_item) {
                            for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                                $disc25 += $custom_item->price * 0.25;
                            }
                        }
                    }
                    
                    $this->cart->add(['sku' => 'OFF256920', 'price' => 0 - $disc25]);
                    $applicable = true;
                } else {
                    # code...
                }
                
            } elseif ($reqcode=='FEST33') {
                if ($this->cart->total > 99) {
                    $disc33 = 0.00;
                    if (Auth::check()) {
                        foreach (Item::where('cart_id', '=', $this->cart->id)->where('tax', '>', 0)->get() as $custom_item) {
                            for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                                $disc33 += $custom_item->price * 0.33;
                            }
                        }
                    } else {
                        foreach (GuestItem::where('guestcart_id', '=', $this->cart->id)->where('tax', '>', 0)->get() as $custom_item) {
                            for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                                $disc33 += $custom_item->price * 0.33;
                            }
                        }
                    }
                    
                    $this->cart->add(['sku' => 'FEST3361011', 'price' => 0 - $disc33]);
                    $applicable = true;
                } else {
                    # code...
                }
                
            } elseif ($reqcode=='MONO100') {
                    foreach ($this->cart->items->where('price', '299.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                            $this->cart->add(['sku' => 'MONO1006831', 'price' => -100]);
                            $applicable = true;
                        }
                    }
                    foreach ($this->cart->items->where('price', '339.00') as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                            $this->cart->add(['sku' => 'MONO1006831', 'price' => -100]);
                            $applicable = true;
                        }
                    }
            } elseif ($reqcode=='MONO50') {
                            $applicable = true;
                if (!Auth::check()) {
                    Session::flash('couponMessage', 'Login to your acount first.');
                } elseif (Auth::User()->orders->count()!=0) {
                    Session::flash('couponMessage', 'Coupon only valid for new users.');
                } else {
                    $disc50 = 0.00;
                    foreach (Item::where('cart_id', '=', $this->cart->id)->where('price', '>', 50)->get() as $custom_item) {
                        for ($itno=1; $itno <=  $custom_item->quantity ; $itno++) {
                            $disc50 += $custom_item->price * 0.5;
                        }
                    }
                    $this->cart->add(['sku' => 'MONO506908', 'price' => 0 - $disc50]);
                }
            } elseif (substr($reqcode, 0, 7)=='FREEDOM') {
                if (Item::where('cart_id', '=', $this->cart->id)->where('price', '=', 229)->count()>0) {
                    $this->cart->add(['sku' => $reqcode, 'price' => -229]);
                            $applicable = true;
                } elseif (Item::where('cart_id', '=', $this->cart->id)->where('price', '=', 269)->count()>0) {
                    $this->cart->add(['sku' => $reqcode, 'price' => -269]);
                            $applicable = true;                }
            }
            if (!$applicable) {
                Session::flash('couponMessage', 'Coupon not applicable.');
            }
            
        }
        else{
            Session::flash('couponMessage', 'Coupon already used.');
        }
        return redirect()->back();
    }
    public function addmessage(Request $request)
    {
        if (Auth::check()) {
            $feedback = new \App\Feedback;
            $feedback->name = Auth::user()->name;
            if ($request->has('order_id')) {
                $feedback->order_id = substr($request->order_id, -4) - 1000;
                $feedback->comment = $request->message;
                session(['cartStatus' => 12]);
            } else {
                $feedback->comment = "Conact Us:
" . $request->message;
                session(['cartStatus' => 4]);
            }
            
            Auth::user()->feedbacks()->save($feedback);
        } else {
            $feedback = new \App\Feedback;
            $feedback->name = $request->name;
            $feedback->comment = "Name: " .$request->name.";
Email: ".$request->email."; 
Phone: ".$request->phone."; 
Message: ".$request->message ;
            $feedback->save();
        }

    $options = array('cluster' => 'ap1', 'encrypted' => true);
    $pusher = new \Pusher('85af98d3bd88e572165f', '1692b81c6311d8a679e4', '219908', $options );

    $data['message'] = 'New Feedback !' ;
    $pusher->trigger('test_channel', 'new_order', $data);
        if ($request->has('order_id')) {
            return redirect('/orders');
        }
        return redirect('/');
        
    }

}
