<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
use Cookie;
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
        if (Auth::user()->cart->count==0) {
            session(['cartStatus' => 2]);
            return redirect('/');
        } else {
            return view('checkout', ['user' => Auth::user(), 'cart' => Auth::user()->cart,]);
        }
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

        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'pincode' => 'required',
            'address' => 'required',
        ]);
        $location = new Location;
        $location->name = $request->name;
        $location->mobile_number = $request->contact;
        $location->pincode = $request->pincode;
        $location->address = $request->address;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->usercomment = $request->comment;
        $location->user_id = Auth::user()->id;
        $location->save();
        session(['selectaddress' => $location->id]);
        return view('checkoutpay', ['user' => Auth::user(), 'selectadd' => $location,]);
        return redirect()->back();
        
    }

    public function editaddress(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'pincode' => 'required',
            'address' => 'required',
        ]);
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

    public function cod(Request $request)
    {

        Shop::setGateway('pay');
        $this->success = Shop::checkout();
        $this->order = Shop::placeOrder();
        $location = Auth::user()->locations()->where('id', session('selectaddress'))->first();
        $dlocation = new \App\DeliveryLocation;
        $dlocation->name = $location->name;
        $dlocation->mobile_number = $location->mobile_number;
        $dlocation->pincode = $location->pincode;
        $dlocation->address = $location->address;
        $dlocation->lat = $location->lat;
        $dlocation->lng = $location->lng;
        $dlocation->usercomment = $location->usercomment;
        $dlocation->comment = $location->comment;
        $this->order->delivery_location()->save($dlocation);
        $oid=$this->order->id+1000;
        $this->order->order_id = 'OD1' . substr($this->order->created_at, 5, 2) . substr($this->order->created_at, 8, 2) . $oid;
        $this->order->statusCode='confirmed';
        $this->order->save();
    $options = array('cluster' => 'ap1', 'encrypted' => true);
    $pusher = new \Pusher('85af98d3bd88e572165f', '1692b81c6311d8a679e4', '219908', $options );

    $data['message'] = 'New Order !
  OrderId : '.$this->order->id.'
  ('.Auth::user()->id.')  '.Auth::user()->name.'
  '.$this->order->delivery_location->address ;
  $pusher->trigger('test_channel', 'new_order', $data);
        session(['cartStatus' => 11]);
        return redirect('/orders');
        
    }

    public function orders()
    {

            if (session()->has('cartStatus')) {
                $this->cs = session('cartStatus');
                session(['cartStatus' => 0]);
            } else {
                $this->cs = 0;
            }
        return view('orders', ['orders' => Auth::user()->orders, 'cart_status' => $this->cs,]);
        
    }
    public function account()
    {

        return view('account', ['user' => Auth::user(),]);
        
    }
    public function feedback()
    {

        return view('feedback', ['user' => Auth::user(),]);
        
    }
    public function addfeedback(Request $request)
    {

        $feedback = new \App\Feedback;
        $feedback->comment = $request->message;
        Auth::user()->feedbacks()->save($feedback);
    $options = array('cluster' => 'ap1', 'encrypted' => true);
    $pusher = new \Pusher('85af98d3bd88e572165f', '1692b81c6311d8a679e4', '219908', $options );

    $data['message'] = 'New Feedback !' ;
  $pusher->trigger('test_channel', 'new_order', $data);
        Cookie::queue('cartStatus', 3);
        return redirect('/');
        
    }
}
