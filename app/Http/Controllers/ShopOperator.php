<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
Use App\Location;
Use App\User;
Use App\Order;
Use App\Feedback;
use App\Http\Requests;
use Illuminate\Http\Request;

class ShopOperator extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orders(Request $request)
    {
	if (Auth::user()->email=='operator@monosoz.com'||Auth::user()->email=='a@monosoz.com') {
        //
        if ($request->has('os')&&$request->has('tm')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->get(),]);
        } elseif ($request->has('os')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereDate('created_at', '=', date('y-m-d'))->get(),]);
        } elseif ($request->has('u')) {
            return view('op.orders_o', ['orders' => Order::where('user_id', '=', $request->u)->get(),]);
        } elseif ($request->has('fb')) {
            return view('op.feedback', ['feedbacks' => Feedback::whereDate('created_at', '=', date('y'))->get(),]);
        } else {
            return view('op.orders_o', ['orders' => Order::all(),]);
        }
        
		
	}else {
        return redirect('/');
    }
    }

    public function changestatus(Request $request)
    {
    if (Auth::user()->email=='operator@monosoz.com'||Auth::user()->email=='a@monosoz.com') {
        //
        $ordertc = User::find($request->user_id)->orders->find($request->order_id);
        $status = $ordertc->statusCode;
        if ($request->status==1) {
            $status = 'complete';
        } elseif ($request->status==2) {
            $status = 'in_process';
        } elseif ($request->status==3) {
            $status = 'cancelled';
        }
        if ($status != $ordertc->statusCode) {
            $ordertc->statusCode = $status;
            $ordertc->save();
        }
        return redirect()->back();
        
        
    }else {
        return redirect('/');
    }
    }
}
