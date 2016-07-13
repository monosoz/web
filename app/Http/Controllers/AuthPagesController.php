<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
use App\Http\Requests;
use Illuminate\Http\Request;

class AuthPagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function pay()
    {
        return view('checkout', ['user' => Auth::user(),]);
        //Shop::setGateway('pay');
        //$this->success = Shop::checkout();
        //$this->order = Shop::placeOrder();
    }
}
