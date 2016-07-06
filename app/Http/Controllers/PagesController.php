<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AddToCart;

use App\Product;

use App\Variant;

use App\Item;

use App\Tag;

use App\Cart;

use App\User;

use App\Auth;

Use Shop;

class PagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        //$this->guestMiddleware('guest');
        //$this->middleware('guest');
        $this->cart = Cart::current();

    }

    public function index()
    {

        return view('main', ['products' => Product::all(), 'tags' => Tag::all(), 'tags' => Tag::all(), 'products' => Product::all(), 'cart' => $this->cart,]);
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

        /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function item(Request $request, $item)
    {
        if ( $request->get('action') == 'rm' ) {
            $this->cart->remove(['sku' => $item]);
        } elseif ( $request->get('action') == 'add' ) {
            $this->cart->add(['sku' => $item]);
        }
        return redirect()->back();
    }
    public function pay()
    {
        Shop::setGateway('pay');
        $this->success = Shop::checkout();
        $this->order = Shop::placeOrder();
        return redirect('/');
    }

}
