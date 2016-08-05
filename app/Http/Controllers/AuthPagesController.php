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
    }

    public function addresses()
    {
        //return $request->all();
        return view('addresses', ['user' => Auth::user(),]);
    }

    public function address(Request $request)
    {
        $location = Auth::user()->locations()->where('id', $request->address_id)->first();
        return view('address', ['location' => $location, 'requrl' => $request->requrl,]);
    }

    public function addaddress(Request $request)
    {

        $location = new Location;
        $location->name = $request->name;
        $location->mobile_number = $request->mobile;
        $location->pincode = $request->pincode;
        $location->address = $request->address;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->usercomment = $request->comment;
        Auth::user()->locations()->save($location);
        return redirect()->back();
        
    }

    public function editaddress(Request $request)
    {

        $location = Auth::user()->locations()->where('id', $request->address_id)->first();
        $location->name = $request->name;
        $location->mobile_number = $request->mobile;
        $location->pincode = $request->pincode;
        $location->address = $request->address;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->usercomment = $request->comment;
        $location->update = substr($location->updated_at, -8);
        Auth::user()->locations()->save($location);
        return redirect($request->requrl);
        
    }

    public function selectaddress(Request $request)
    {

        $location = Auth::user()->locations()->where('id', $request->address_id)->first();
        session(['selectaddress' => $request->address_id]);
        $location->update = substr($location->updated_at, -8);
        Auth::user()->locations()->save($location);
        return view('checkoutpay', ['user' => Auth::user(), 'selectadd' => Auth::user()->locations()->where('id', session('selectaddress'))->first(),]);
        
    }

    public function deleteaddress(Request $request)
    {

        $location = Auth::user()->locations()->where('id', $request->address_id)->first();
        $location->delete();
        return redirect()->back();
        
    }

    public function transact(Request $request)
    {

        Shop::setGateway('pay');
        $this->success = Shop::checkout();
        $this->order = Shop::placeOrder();
        return redirect('/orders');
        
    }

    public function orders(Request $request)
    {

        return redirect('/');
        
    }
    public function account(Request $request)
    {

        return redirect('/');
        
    }
}
