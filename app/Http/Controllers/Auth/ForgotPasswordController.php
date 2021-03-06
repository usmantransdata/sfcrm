<?php

namespace App\Http\Controllers\Auth;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Mail\ForgotPassword;
use Mail;

class ForgotPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*public function retrivePassword(Request $request){

        $user = User::where('email', '=', $request['email'])->get();
   // print_r($user);dD();
        Mail::to($request['email'])->send(new ForgotPassword($user));

        $request->session()->flash('notification', 'We just email you password reset link to you');
           return redirect()->back();
    }

    public function forgotPassword(){
        echo "string";dd();
    }*/
}
