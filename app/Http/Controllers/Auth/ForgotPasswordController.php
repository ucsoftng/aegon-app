<?php

namespace App\Http\Controllers\Auth;

use App\BasicSetting;
use App\Category;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Page;
use App\Payment;
use App\Traits\MailTrait;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ForgotPasswordController extends Controller
{
    use MailTrait;
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
    public function showLinkRequestForm()
    {
        $general = GeneralSetting::first();
        $data['site_title'] = $general->title;
        $data['page_title'] = 'User Password Reset';
        $data['page'] = Page::first();
        $data['payment'] = Payment::first();
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        return view('auth.passwords.email',$data)->withGeneral($general);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $us = User::whereemail($request->email)->count();
        if ($us == 0)
        {
            session()->flash('message','We can\'t find a user with that e-mail address.');
            session()->flash('type','danger');
            return redirect()->back();
        }else{
            $token = $this->userPasswordReset($request->email);
            $general = GeneralSetting::first();
            $data['site_title'] = $general->title;
            $data['page_title'] = 'User Password Reset';
            $data['basic'] = BasicSetting::first();
            $data['token'] = $token;
            session()->flash('message','Password Reset OTP Sent Your E-mail');
            session()->flash('type','success');
            return view('auth.passwords.pass-reset',$data);
        }

    }
}
