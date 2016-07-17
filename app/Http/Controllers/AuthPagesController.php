<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
Use App\Location;
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

    public function checkout()
    {
        return view('checkout', ['user' => Auth::user(),]);
        //Shop::setGateway('pay');
        //$this->success = Shop::checkout();
        //$this->order = Shop::placeOrder();
    }

    public function address(Request $request)
    {

        //return $request->all();
        $location = new Location;
        $location->name = $request->name;
        $location->mobile_number = $request->mobile;
        $location->pincode = $request->pincode;
        $location->address = $request->address;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->usercomment = $request->comment;
        Auth::user()->locations()->save($location);
        return view('checkout', ['user' => Auth::user(),]);
        return redirect()->back();
        
    }
}
