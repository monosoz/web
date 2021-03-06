<?php

namespace App\Http\Controllers;

use Auth;
Use Shop;
Use App\Location;
Use App\User;
Use App\Order;
Use App\Item;
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
        if ($request->has('os') && $request->has('tm') && $request->has('t')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()-86400*$request->t) . ' 23:59:59'])->get(),]);
        } elseif ($request->has('tm') && $request->has('t')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', 'complete')->whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()-86400*$request->t) . ' 23:59:59'])->get(),]);
        } elseif ($request->has('d')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', 'complete')->whereBetween('created_at', [date('y-m-d', time()-86400*$request->d) . ' 00:00:00', date('y-m-d', time()-86400*$request->d) . ' 23:59:59'])->get(),]);
        } elseif ($request->has('os') && $request->has('tm')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()) . ' 00:00:01'])->get(),]);
        } elseif ($request->has('os')) {
            return view('op.orders_o', ['orders' => Order::where('statusCode', '=', $request->os)->whereDate('created_at', '=', date('y-m-d'))->get(),]);
        } elseif ($request->has('tm')) {
            return view('op.orders_o', ['orders' => Order::whereBetween('created_at', [date('y-m-d', time()-86400*$request->tm) . ' 00:00:00', date('y-m-d', time()) . ' 00:00:01'])->get(),]);
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
                    if ($user->orders->count()>-1) {
    $tosmskey = '124443AMVTHynd57cc7231';
    $name = $user->name;
    $fname = explode(' ', trim($name));
    $message = urlencode("Enjoy this winter with a hot delicious pizza. Get 25% off during HAPPY HOURS (12:30PM-4:30PM). Use code HAPPY25 @ www.monosoz.com");
/*
    $message = urlencode("Get a LARGE CHEESILICIOUS pizza delivered @ your doorstep with flat 25% off. Use code 'BESTBUY' @ www.monosoz.com");
    $message = urlencode("Dushehra offer: Get 33% OFF on all pizzas. Offer applicable only on 11th Oct.
Use Code FEST33 @ www.monosoz.com");
    $message = urlencode("Dear customer,
Enjoy our new and improved MONOSOZ pizza at 25% off (excluding taxes).
Use code OFF25 @ www.monosoz.com");
    $message = urlencode("Hi " . substr($fname[0], 0, 15) . " 
Try new range of Non-Veg and Veg Pizzas @ MONOSOZ
Use code OFF100 for medium and MONO100 for large pizza and get ₹100 off only @ www.monosoz.com");
    $xml = file_get_contents("http://dashboard.tosms.in/api/sendhttp.php?authkey=" . $tosmskey . "&mobiles=91" . substr($user->mobile_number, -10) . "&message=" . $message . "&sender=MONOSZ&route=4&country=91&unicode=0");
*/
    $apilink = "https://control.msg91.com/api/sendhttp.php?authkey=" . $tosmskey . "&mobiles=" . substr($user->mobile_number, -10) . "&message=" . $message . "&sender=MONOSZ&route=4&country=91";
    $xml = file_get_contents($apilink);
        ;
                $retstr = $retstr . '<br>
' . substr($fname[0], 0, 15) . ' - ' . substr($user->mobile_number, -10) . ' ' . $xml;
                    }
                }
            } elseif ($request->sms=='qws') {
                $from = $request->f + 1;
                $to = $request->t;
                $mobile_numbers = "91" . substr(User::find($request->f)->mobile_number, -10);
                foreach (User::whereBetween('id', [$from, $to])->get() as $user) {
                    if ($user->orders->count()>-1) {
                        $mobile_numbers = $mobile_numbers . ",91" . substr($user->mobile_number, -10);
                        $name = $user->name;
                        $fname = explode(' ', trim($name));
                        $retstr = $retstr . '<br>
' . substr($fname[0], 0, 15) . ' - ' . substr($user->mobile_number, -10) . ' ';
                    }
                }
    $tosmskey = '124443AMVTHynd57cc7231';
    $message = urlencode("Enjoy this winter with a hot delicious pizza. Get 25% off during HAPPY HOURS (12:30PM-4:30PM). Use code HAPPY25 @ www.monosoz.com");
/*
*/
    $apilink = "https://control.msg91.com/api/sendhttp.php?authkey=" . $tosmskey . "&mobiles=" . $mobile_numbers . "&message=" . $message . "&sender=MONOSZ&route=4&country=91";
    $xml = file_get_contents($apilink);
            }
            return $retstr . "---end.<br>" . $xml . "<br>" . $apilink;
        } elseif ($request->has('fu')) {
            $retstr="";
            if ($request->fu=='m') {
                $user=User::where('mobile_number', '=', $request->m)->first();
            } elseif ($request->has('t')) {
                $user=User::whereBetween('id', [$request->fu, $request->t])->get();
            } else {
                $user=User::where('id', '=', $request->fu)->first();
            }
            return $user;
//         } elseif ($request->has('taxoff')) {
//             $total=0;
//             foreach (Item::where('price', '<' , -1)->get() as $item) {
//                 $item->tax = $item->price * 0.125;
//                 $total += $item->tax;
//                 $item->save();
//             }
//             return "Total ".$total;
//         } elseif ($request->has('dt') && $request->has('t')) {
//             $retstr="Date,  Total,  Discount,   Orders";
//             $total = 0;
//             $disc = 0;
//             $oc = 0;
//             for ($i=0; $i < $request->t; $i++) {
//                 $d = $request->dt - $i;
//                 foreach (Order::where('statusCode', '=', 'complete')->whereBetween('created_at', [date('y-m-d', time()-$d*86400) . ' 00:00:00', date('y-m-d', time()-$d*86400) . ' 23:59:59'])->get() as $order) {
//                     $oc +=1;
//                     $total += round($order->total);
//                     if (Item::where('order_id', '=', $order->id)->where('price', '<', 0)->first() != null) {
//                         $disc -= Item::where('order_id', '=', $order->id)->where('price', '<', 0)->first()->price;
//                     }
//                 }
//                 $retstr = $retstr . ";
// <br>" . date('d-m-y', time()-86400*($request->dt-$i)) . ", " . $total . ", " . $disc . ", " . $oc;
//             $total = 0;
//             $disc = 0;
//             $oc = 0;
//             }
//             return $retstr;
//             return view('op.orders_o', ['orders' => Order::where('statusCode', '=', 'complete')->whereBetween('created_at', [date('y-m-d', time()-86400*$request->d) . ' 00:00:00', date('y-m-d', time()-86400*$request->d) . ' 23:59:59'])->get(),]);
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
