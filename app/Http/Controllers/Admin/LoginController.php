<?php

namespace App\Http\Controllers\Admin;

use App\BasicSetting;
use App\Category;
use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Page;
use App\Payment;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
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
        return view('admin.login',$data)->withGeneral($general);
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function username()
    {
        return 'username';
    }
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }
    public function logout()
    {
        $this->guard('admin')->logout();
        session()->flash('message', 'Just Logged Out!');
        return redirect('/admin');
    }
}
