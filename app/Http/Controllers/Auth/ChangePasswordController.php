<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Change Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password change requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Create a new password change controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangeForm(Request $request, $token = null)
    {

        return view('auth.passwords.change', ['user' => Auth::user(),]);
    }
    public function change(Request $request)
    {
        $user = Auth::user();

        $validation = Validator::make(Request::all(), [

        // Here's how our new validation rule is used.
        'password' => 'hash:' . $user->password,
        'new_password' => 'required|different:password|confirmed'
        ]);

        if ($validation->fails()) {
        return redirect()->back()->withErrors($validation->errors());
        }

        $user->password = Hash::make(Request::input('new_password'));
        $user->save();

        return redirect('/account')
        ->with('status', 'Your new password is now set!');
    }
}