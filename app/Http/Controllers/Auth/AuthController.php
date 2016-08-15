<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile_number' => 'required|regex:/\d{10}/|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));
        $this->movecart();

        return redirect()->back();
    }

    protected function authenticated()
    {
        if (session()->has('cartId')) {
                $this->movecart();
            }
        return redirect()->intended($this->redirectPath());
    }

    protected function movecart()
    {
        $tcart= \App\GuestCart::findOrFail(session('cartId'));
        $cart = \App\Cart::current();
            $tcart->cart_id = $cart->id;
            $tcart->save();
        foreach ($tcart->items as $item) {
            if ($item->hasObject) {
                $cart->add($item->object, $item->quantity);
            }
            else{
                $cart->add(['sku' => $item->sku, 'price' => $item->price,]);
                }

            
        }
        foreach ($tcart->items as $item) {
            //
            foreach ($cart->items as $nitem) {
                if ($nitem->sku==$item->sku) {
                    if ($itemrs=\App\GuestItemRelation::where('parent_id', '=', $item->id)->get()) {
                        foreach ($itemrs as $itemr) {
                            $gitr=\App\ItemRelation::create(['parent_id'=> $nitem->id, 'item_no'=> $nitem->quantity,'child_id' => $itemr->child_id,]);
                        $gitr->save();
                        }
                    }
                    
                    
                }
            }//

            
        }

        
        $tcart->clear();
    }
}
