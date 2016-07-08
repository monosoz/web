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
        //$this->middleware('auth');
        //$this->guestMiddleware('guest');
        //$this->middleware('guest');

        if (Auth::check()) {
            $this->cart = Cart::current();
            if (!session('cartclear')) {
                $tcart=GuestCart::findOrFail(session('cartId'));
                foreach ($tcart->items as $item) {
                    if ($item->hasObject) {
                        $this->cart->add($item->object, $item->count());
                    }
                    else{
                        $this->cart->add(['sku' => $item->sku, 'price' => $item->price,], $item->quantity);
                    }
                }
                $tcart->clear();
                session(['cartclear' => true]);
            }
        } else {
            if (session()->has('cartId')) {
                $this->cart = GuestCart::findOrFail(session('cartId'));
                session(['cartclear' => false]);
            } else {
                $this->cart = GuestCart::create();
                session(['cartId' => $this->cart->id, 'cartclear' => false]);
            }
        }
        

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
