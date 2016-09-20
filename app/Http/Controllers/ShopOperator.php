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
        if ($request->has('os') && $request->has('tm')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()) . ' 23:59:59'])->get(),]);
        } elseif ($request->has('os')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereDate('created_at', '=', date('y-m-d'))->get(),]);
        } elseif ($request->has('tm')) {
            return view('op.orders_o', ['orders' => Order::whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()) . ' 23:59:59'])->get(),]);
        } elseif ($request->has('u')) {
            return view('op.orders_o', ['orders' => Order::where('user_id', '=', $request->u)->get(),]);
        } elseif ($request->has('fb')) {
            return view('op.feedback', ['feedbacks' => Feedback::all(),]);
        } elseif ($request->has('sms')) {
            $retstr="";
            if ($request->sms=='qwa') {
                $from = $request->f;
                $to = $request->t;
                foreach (User::whereBetween('id', [$from, $to])->get() as $user) {
    $tosmskey = '124443AMVTHynd57cc7231';
    $name = $user->name;
    $fname = explode(' ', trim($name));
    $message = urlencode("Dear customer,
Enjoy our new and improved MONOSOZ pizza at 25% off (excluding taxes).
Use code OFF25 @ www.monosoz.com");
/*
    $message = urlencode("Hi " . substr($fname[0], 0, 15) . " 
Try new range of Non-Veg and Veg Pizzas @ MONOSOZ
Use code OFF100 for medium and MONO100 for large pizza and get ₹100 off only @ www.monosoz.com");
*/
    $xml = file_get_contents("http://dashboard.tosms.in/api/sendhttp.php?authkey=" . $tosmskey . "&mobiles=91" . substr($user->mobile_number, -10) . "&message=" . $message . "&sender=MONOSZ&route=4&country=91&unicode=0");
                $retstr = $retstr . '<br>
' . substr($fname[0], 0, 15) . ' - ' . substr($user->mobile_number, -10) . ' ' . $xml;
                }
            }
            return $retstr;
        } else {
            return view('op.orders_o', ['orders' => Order::whereDate('created_at', '=', date('y-m-d'))->get(),]);
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
        } elseif ($request->status==5) {
            $status = 'out_for_delivery';
        } elseif ($request->status==3) {
            $status = 'cancelled';
        } elseif ($request->status==4) {
            $status = 'confirmed';
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
