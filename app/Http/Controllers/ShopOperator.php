<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
Use App\Location;
Use App\Order;
use App\Http\Requests;
use Illuminate\Http\Request;

class ShopOperator extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orders()
    {
		if (Auth::user()->email=='operator@monosoz.com'||true) {
			return view('orders_o', ['orders' => Order::all(),]);
		}
    }
}
