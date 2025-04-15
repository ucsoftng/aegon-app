<?php

namespace App\Http\Controllers\Auth;

use App\BasicSetting;
use App\Category;
use App\GeneralSetting;
use App\Mail\verifyEmail;
use App\Menu;
use App\Page;
use App\Payment;
use App\Traits\MailTrait;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $basic = BasicSetting::first();
        if ($basic->reCaptcha_status == 1){
            Config::set('captcha.secret', $basic->secret_key);
            Config::set('captcha.sitekey', $basic->site_key);
        }
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        $general = GeneralSetting::first();
        $bas = BasicSetting::first();
        $data['basic'] = $bas;
        if($bas->registration_status == 1)
        {
            $data['site_title'] = $general->title;
            $data['page_title'] = 'User Registration';
            $data['page'] = Page::first();
            $data['payment'] = Payment::first();
            $data['category'] = Category::all();
            $data['menu'] = Menu::all();
            if ($bas->reCaptcha_status == 0) {
                $data['captcha_status'] = 0;
            }else{
                $data['captcha_status'] = 1;
            }
            return view('auth.register',$data)->withGeneral($general);
        }
        else{
            return redirect()->route('login');
        }
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $basic = BasicSetting::first();

        if($request->reference == null)
        {
            $request->reference = $basic->reference_id;
        }
        $ref = \Illuminate\Foundation\Auth\User::where('reference',$request->reference)->count();
        if ($basic->reference_id == $request->reference)
        {
            event(new Registered($user = $this->create($request->all())));
        }elseif ($ref != 0)
        {
            event(new Registered($user = $this->create($request->all())));
        }else{
            $request->session()->flash('message','Opps..! Reference ID not Correct.');
            $request->session()->flash('type','danger');
            return redirect()->route('register');
        }

        if ($basic->verify_status == 1)
        {
            $request->session()->flash('message','A verification code has been sent to your mail, Please check your inbox.');
            $request->session()->flash('type','success');
            return redirect()->route('otp');
        }else{

            $request->session()->flash('message','Registration Successfully Completed. Please Log In Now.');
            $request->session()->flash('type','success');
            return redirect()->route('login');

            /*$this->guard()->login($user);
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());*/
        }

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
//            'reference' => 'required',
            'g-recaptcha-response' => 'captcha',
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
        $basic = BasicSetting::first();
        if($data['reference'] == null)
        {
            $data['reference'] = $basic->reference_id;
        }
        $status = $basic->verify_status == 1 ? '0' : '1';
        $image25 = 'user-default.png';
        if ($basic->reference_id == $data['reference'])
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
//                'phone' => $data['phone'],
//                'address' => $data['address'],
//                'country' => $data['country'],
//                'zip' => $data['zip'],
                'under_reference' => $data['reference'],
                'password' => bcrypt($data['password']),
                'verifyToken' => Str::random(40),
                'reference' => Str::random(12),
                'status' => $status,
                'image' => $image25,
                'otp_code' => sprintf("%04d", mt_rand(1, 9999))
            ]);
        }else{
            $us = User::whereReference($data['reference'])->count();
            $use = User::whereReference($data['reference'])->first();
            if ($us != 0)
            {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
//                    'country' => $data['country'],
//                    'zip' => $data['zip'],
//                    'phone' => $data['phone'],
//                    'address' => $data['address'],
                    'under_reference' => $data['reference'],
                    'password' => bcrypt($data['password']),
                    'verifyToken' => Str::random(40),
                    'reference' => Str::random(12),
                    'status' => $status,
                    'image' => $image25,
                    'otp_code' => sprintf("%04d", mt_rand(1, 9999))
                ]);
                
                $general = GeneralSetting::first();
                $hh  = ['s_title'=>$general->title,'s_footer'=>$general->footer_bottom_text];
                $mail_val = [
                      'email' => $use->email,
                        'name' => $use->name,
                        'g_email' => $general->email,
                        'g_title' => $general->title,
                        'subject' => 'Downliner Registration Notification',
                    ];
                    Config::set('mail.driver','mail');
                    Config::set('mail.from',$general->email);
                    Config::set('mail.name',$general->title);
                    Mail::send('emails.downliner-email', ['email' =>$use->email ,'name'=>$use->name,'rename'=> $data['name'], 'site_title'=>$hh['s_title'],'site_footer'=>$hh['s_footer']], function ($m) use ($mail_val) {
                        $m->from($mail_val['g_email'], $mail_val['g_title']);
                        $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
                    });
            }else{
                Session::flash('type','danger');
                Session::flash('message','Opps.. Your Reference ID in not Correct.');
                return redirect()->route('home');
            }
        }

        if ($basic->verify_status == 1){
            $thisUser = User::findOrFail($user->id);
            $this->sendEmail($thisUser);
        }
        return $user;
    }
    public function sendEmail($thisUser)
    {
        $general = GeneralSetting::first();

        $hh  = ['s_title'=>$general->title,'s_footer'=>$general->footer_bottom_text];

        $mail_val = [
              'email' => $thisUser['email'],
                'name' => $thisUser['name'],
                'g_email' => $general->email,
                'g_title' => $general->title,
                'subject' => 'OTP Verification',
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name',$general->title);
            Mail::send('auth.verify-email', ['email' =>$thisUser['email'] ,'verifyToken'=>$thisUser['verifyToken'],'otp'=>$thisUser['otp_code'],'site_title'=>$hh['s_title'],'site_footer'=>$hh['s_footer']], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });

    }
    public function verifyDone($email,$verifyToken)
    {
//        $user = User::where(['email'=>$email,'verifyToken'=>$verifyToken])->first();
        $user = User::where(['email'=>$email,'otp'=>$verifyToken])->first();
        if ($user)
        {
//            User::where(['email'=>$email,'verifyToken'=>$verifyToken])->update(['status'=>1,'verifyToken'=>null]);
            User::where(['email'=>$email,'otp'=>$verifyToken])->update(['status'=>1,'verifyToken'=>null]);
            Session::flash('type','success');
            Session::flash('message','Your Account Verified Successfully. Please Log In Now.');
            return redirect()->route('login');
        }else{
            Session::flash('type','danger');
            Session::flash('message','Opps..! Something is Wrong. Check OTP and Try Again!');
            return redirect()->route('login');
        }
    }
    public function verifyOTP(Request $request)
    {
        $otp = collect($request->otp)->implode('');
        $user = User::where(['otp_code'=>$otp])->first();
        if ($user)
        {
            User::where(['otp_code'=>$otp])->update(['status' => 1,'verifyToken'=>null]);
            Session::flash('type','success');
            Session::flash('message','Your Account Verified Successfully. Please Log In Now.');
            return redirect()->route('login');
        }else{
            Session::flash('type','danger');
            Session::flash('message','Opps..! Something is Wrong. Check OTP and Try Again!');
            return redirect()->route('otp');
        }
    }
}
