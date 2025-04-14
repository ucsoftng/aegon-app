<?php

namespace App\Http\Controllers\Auth;

use App\BasicSetting;
use App\Category;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateSecretRequest;
use App\Menu;
use App\Page;
use App\Payment;
use App\Traits\MailTrait;
use App\User;
use App\UserLogin;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, MailTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm()
    {
        $general = GeneralSetting::first();
        $data['site_title'] = $general->title;
        $data['page_title'] = 'User Login page';
        $data['page'] = Page::first();
        $data['payment'] = Payment::first();
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        return view('auth.login',$data)->withGeneral($general);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        
        $basic = BasicSetting::first();
        if ($basic->verify_status == 0)
        {
            return ['email'=>$request->{$this->username()},'password'=>$request->password];
        }else{
            return ['email'=>$request->{$this->username()},'password'=>$request->password];
        }

    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status == 0 )
        {
            $this->guard()->logout();
            session()->flash('message','You need to confirm your account. We have sent you an OTP to your email, please check your email.');
            session()->flash('type','danger');
            return redirect('/otp');
        }
        if($user->block_status == 1)
        {
            $this->guard()->logout();
            session()->flash('message','Sorry.. Your Account is blocked, please contact Support now.');
            session()->flash('type','danger');
            return redirect('/login');
        }
        if ($user->two_fa)
        {
            $this->guard()->logout();

            $request->session()->put('2fa:user:id', $user->id);
            if (session('2fa:user:id')) {
                $user->otp_code = sprintf("%04d", mt_rand(1, 9999));
                $user->update();
                $this->send2FAEmail($user);
                return view('auth/2fa');
            }
            return redirect('login');
        }

//        $ip = NULL; $deep_detect = TRUE;
//
//        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
//            $ip = $_SERVER["REMOTE_ADDR"];
//            if ($deep_detect) {
//                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
//                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
//                    $ip = $_SERVER['HTTP_CLIENT_IP'];
//            }
//        }
//        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);
//
//        $country =  $xml->geoplugin_countryName ;
//        $city = $xml->geoplugin_city;
//        $area = $xml->geoplugin_areaCode;
//        $code = $xml->geoplugin_countryCode;
//
//        $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
//        $os_platform    =   "Unknown OS Platform";
//        $os_array       =   array(
//            '/windows nt 10/i'     =>  'Windows 10',
//            '/windows nt 6.3/i'     =>  'Windows 8.1',
//            '/windows nt 6.2/i'     =>  'Windows 8',
//            '/windows nt 6.1/i'     =>  'Windows 7',
//            '/windows nt 6.0/i'     =>  'Windows Vista',
//            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
//            '/windows nt 5.1/i'     =>  'Windows XP',
//            '/windows xp/i'         =>  'Windows XP',
//            '/windows nt 5.0/i'     =>  'Windows 2000',
//            '/windows me/i'         =>  'Windows ME',
//            '/win98/i'              =>  'Windows 98',
//            '/win95/i'              =>  'Windows 95',
//            '/win16/i'              =>  'Windows 3.11',
//            '/macintosh|mac os x/i' =>  'Mac OS X',
//            '/mac_powerpc/i'        =>  'Mac OS 9',
//            '/linux/i'              =>  'Linux',
//            '/ubuntu/i'             =>  'Ubuntu',
//            '/iphone/i'             =>  'iPhone',
//            '/ipod/i'               =>  'iPod',
//            '/ipad/i'               =>  'iPad',
//            '/android/i'            =>  'Android',
//            '/blackberry/i'         =>  'BlackBerry',
//            '/webos/i'              =>  'Mobile'
//        );
//        foreach ($os_array as $regex => $value) {
//            if (preg_match($regex, $user_agent)) {
//                $os_platform    =   $value;
//            }
//        }
//        $browser        =   "Unknown Browser";
//        $browser_array  =   array(
//            '/msie/i'       =>  'Internet Explorer',
//            '/firefox/i'    =>  'Firefox',
//            '/safari/i'     =>  'Safari',
//            '/chrome/i'     =>  'Chrome',
//            '/edge/i'       =>  'Edge',
//            '/opera/i'      =>  'Opera',
//            '/netscape/i'   =>  'Netscape',
//            '/maxthon/i'    =>  'Maxthon',
//            '/konqueror/i'  =>  'Konqueror',
//            '/mobile/i'     =>  'Handheld Browser'
//        );
//        foreach ($browser_array as $regex => $value) {
//            if (preg_match($regex, $user_agent)) {
//                $browser    =   $value;
//            }
//        }
        $user->login_time = Carbon::now();
        $user->save();
//        $usee = UserLogin::whereuser_id($user->id)->exists();
//        if(!$usee)
//        {
//            $ul['user_id'] = $user->id;
//            $ul['user_ip'] = $ip;
//            $ul['location'] = $city.(" - $area - ").$country .(" - $code ");
//            $ul['details'] = $browser.' on '.$os_platform;
//            UserLogin::create($ul);
//        }
//        else{
//            $u = UserLogin::whereuser_id($user->id)->first();
//            $ul['user_ip'] = $ip;
//            $ul['location'] = $city.(" - $area - ").$country .(" - $code ");
//            $ul['details'] = $browser.' on '.$os_platform;
//            $u->update();
//        }

//        return redirect()->intended($this->redirectPath());
    }

//    public function postValidateToken(ValidateSecretRequest $request)
    public function postValidateToken(Request $request)
    {
        //get user id and create cache key
        $userId = session('2fa:user:id');
        $user = User::findorfail($userId);

        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        if($user->otp_code == $request->totp){
            //login and redirect user
            Auth::loginUsingId($userId);

            return redirect()->intended($this->redirectTo);
        }else{
            session()->flash('message','Sorry.. Your OTP is Invalid.');
            session()->flash('type','danger');
            $this->guard()->logout();
            return redirect('login');
        }
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/login');
    }
}
