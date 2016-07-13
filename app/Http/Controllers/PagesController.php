<?php

namespace App\Http\Controllers;

use Auth;

Use Shop;

use Illuminate\Http\Request;

use App\Http\Requests\AddToCart;

use App\Product;

use App\Variant;

use App\Item;

use App\Tag;

use App\Cart;

use App\GuestItem;

use App\GuestCart;

use App\User;

class PagesController extends Controller
{
	public function __construct()
    {

        if (Auth::check()) {
            $this->cart = Cart::current();
        } else {
            if (session()->has('cartId')) {
                $this->cart = GuestCart::findOrFail(session('cartId'));
            } else {
                $this->cart = GuestCart::create();
                session(['cartId' => $this->cart->id]);
            }
        }
    }

    public function index()
    {

        return view('main', ['products' => Product::all(), 'tags' => Tag::all(), 'cart' => $this->cart,]);
    }

    public function cart(AddToCart $request)
    {

        $this->cart->add(Variant::findOrFail($request->get('id')));

        //$this->cart->add(['sku' => 'PROD0002', 'price' => 199]);
        //Shop::setGateway('pay');
        //$this->success = Shop::checkout();
        //$this->order = Shop::placeOrder();
        return redirect()->back();
    }

    public function item(Request $request, $item)
    {
        if ( $request->get('action') == 'rm' ) {
            $this->cart->remove(['sku' => $item], 1);
        } elseif ( $request->get('action') == 'add' ) {
            $this->cart->add(['sku' => $item]);
        }
        return redirect()->back();
    }

}
