<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminBalance;
use App\Advert;
use App\BasicSetting;
use App\Category;
use App\Chose;
use App\Compound;
use App\Currency;
use App\Deposit;
use App\Fund;
use App\FundLog;
use App\GeneralSetting;
use App\Letter;
use App\LiveTrade;
use App\Location;
use App\Mail\NewsLetter;
use App\ManualFund;
use App\ManualPayment;
use App\Member;
use App\News;
use App\Partner;
use App\Payment;
use App\PaymentWallet;
use App\Photo;
use App\Plan;
use App\PlanType;
use App\Promo;
use App\RebeatLog;
use App\Reference;
use App\Repeat;
use App\Report;
use App\SaveAd;
use App\Slider;
use App\Strategy;
use App\SubCategory;
use App\Support;
use App\SupportMessage;
use App\Testimonial;
use App\TradeSetting;
use App\User;
use App\UserBalance;
use App\UserCompounding;
use App\UserReferral;
use App\UserWallet;
use App\Withdraw;
use App\TradingActivity;
use App\TradingActivityDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use mysql_xdevapi\Exception;

class DashboardController extends Controller
{
    public function __construct()
    {
        $data = [];
        $data['general'] = GeneralSetting::first();
        $this->middleware('auth:admin');
        $general_all = GeneralSetting::first();
        $this->site_title = $general_all->title;
        $this->gen_phone = $general_all->number;
        $this->gen_email = $general_all->email;
        $this->site_color = $general_all->color;
    }

    public function getDashboard()
    {
        $data['site_title'] = $this->site_title;
        $data['page_title'] = "Dashboard";
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $basic = Payment::first();
        $data['current_balance'] = $data['basic']->admin_total;
        $data['total_deposit'] = Deposit::sum('amount');
        $data['total_withdraw_bal'] = Withdraw::sum('amount');
        $data['total_user'] = User::all()->count();
        $data['total_active'] = User::whereStatus(1)->whereBlock_status(0)->count();
        $data['total_block'] = User::whereBlock_status(1)->count();
        $data['total_unverify'] = User::whereStatus(0)->count();
        $data['total_plan'] = Plan::all()->count();
        $data['active_plan'] = Plan::whereStatus(1)->count();
        $data['deactive_plan'] = Plan::whereStatus(0)->count();
        $pp = 0;
        if ($basic->paypal_status == 1){
            $pp = $pp +1;
        }if ($basic->perfect_status == 1){
        $pp = $pp +1;
    }if ($basic->btc_status == 1){
        $pp = $pp +1;
    }if ($basic->stripe_status == 1){
        $pp = $pp +1;
    }
//        $data['active_fund'] = $pp;
        $data['active_fund'] = PaymentWallet::count();
        $data['total_withdraw'] = ManualPayment::all()->count();
        $data['active_withdraw'] = ManualPayment::whereStatus(1)->count();
        $data['withdraw_total'] = Withdraw::all()->count();
        $data['withdraw_pending'] = Withdraw::whereStatus(0)->count();
        $data['withdraw_success'] = Withdraw::whereStatus(1)->count();
        $data['withdraw_refund'] = Withdraw::whereStatus(2)->count();
        return view('dashboard.dashboard', $data);
    }
    public function adminActivity()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Admin All Activity";
        $data['activity'] = AdminBalance::orderBy('id','desc')->get();
        return view('dashboard.admin-activity',$data);
    }
    public function editProfile()
    {
        $data['page_title'] = "Edit Profile";
        $general_all = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['site_title'] = $general_all->title;
        $data['general'] = $general_all;
        $data['admin'] = Admin::findOrFail(Auth::guard('admin')->user()->id);
        return view('dashboard.edit-profile',$data);
    }
    public function updateProfile(Request $request)
    {

        $ad = Admin::first();
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$ad->id,
            'image' => 'mimes:jpg,png,gif,jpeg'
        ]);
        $add = $request->except('_token','_method');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->save($location);
            $add['image'] = $filename;
        }
        $ad->fill($add)->save();
        session()->flash('message', 'Profile Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        $general_all = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['general'] = $general_all;
        $data['site_title'] = $general_all->title;
        return view('dashboard.change-pass',$data);
    }
    public function postChangePass(Request $request)
    {

        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:6|confirmed'
        ]);

        try {
            $c_password = Auth::guard('admin')->user()->password;
            $c_id = Auth::guard('admin')->user()->id;

            $user = Admin::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                Session::flash('type', 'success');
                Session::flash('title', 'Success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Password Not Match');
                Session::flash('type', 'warning');
                Session::flash('title', 'Opps..!');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', 'Some Problem Occurs, Please Try Again!');
            Session::flash('type', 'warning');
            return redirect()->back();
        }

    }
    public function getManualPayment()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Manual Payment Method";
        $data['method'] = ManualPayment::orderBy('id', 'Asc')->get();
        $data['basic'] = BasicSetting::first();
        return view('payment.manual-payment-show', $data);
    }
    public function storeManualPayment(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:manual_payments,title',
            'method_time' => 'required',
            'method_fix' => 'required',
            'method_percent' => 'required',
            'method_min' => 'required',
            'method_max' => 'required',
        ]);
        $category = ManualPayment::create($request->all());
        return Response::json($category);
    }
    public function editManualPayment($task_id)
    {
        $category = ManualPayment::find($task_id);
        return Response::json($category);
    }
    public function updateManualPayment(Request $request,$task_id)
    {
        $cat = ManualPayment::find($task_id);

        $request->validate([
            'title' => 'required|unique:manual_payments,title,'.$cat->id,
            'method_time' => 'required',
            'method_fix' => 'required',
            'method_percent' => 'required',
            'method_min' => 'required',
            'method_max' => 'required',
        ]);

        $cat->title = $request->title;
        $cat->method_time = $request->method_time;
        $cat->method_fix = $request->method_fix;
        $cat->method_percent = $request->method_percent;
        $cat->method_min = $request->method_min;
        $cat->method_max = $request->method_max;
        $cat->save();
        return Response::json($cat);

    }
    public function paymentActive(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);
        $p = ManualPayment::findOrFail($request->id);
        if ($p->status == 0) {
            $p->status = 1;
            $p->save();
            session()->flash('message', 'Payment Method Activate Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }else{
            $p->status = 0;
            $p->save();
            session()->flash('message', 'Payment Method DeActivate Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function getCategory()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage News Category";
        $data['category'] = Category::orderBy('id', 'DESC')->paginate(10);
        return view('news.news-category', $data);
    }

    public function storeCategory(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:categories,name',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Category::create($request->all());
            return Response::json($category);
        }
    }
    public function editCategory($task_id)
    {
        $category = Category::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateCategory(Request $request,$task_id)
    {


        $cat = Category::find($task_id);
        $rules = array(
            'name' => 'required|unique:categories,name,'.$cat->id,
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function createNews()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New News";
        $data['category'] = Category::all();
        return view('news.news-create', $data);
    }
    public function storeNews(Request $request)
    {


        $this->validate($request,[
            'title' => 'required|unique:news,title',
            'category_id' => 'required',
            'description' => 'required'
        ]);
        News::create($request->all());
        session()->flash('message', 'News Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showNews()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage All News";
        $data['news'] = News::orderBy('id','desc')->get();
        return view('news.news-show', $data);
    }
    public function editNews($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage All News";
        $data['news'] = News::findOrFail($id);
        $data['category'] = Category::all();
        return view('news.news-edit', $data);
    }
    public function updateNews(Request $request,$id)
    {


        $new = News::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|unique:news,title,'.$new->id,
            'category_id' => 'required',
            'description' => 'required',
        ]);
        $new->fill($request->all())->save();
        session()->flash('message', 'News Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function viewNews($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Single News View";
        $data['news'] = News::findOrFail($id);
        return view('news.news-view', $data);
    }
    public function deleteNews(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);
        News::destroy($request->id);
        session()->flash('message', 'News Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('news-show');
    }
    public function managePayment()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Manage Payment Method";
        $data['basic'] = BasicSetting::first();
        $data['payment'] = Payment::first();
        return view('payment.payment-show', $data);
    }
    public function updateManagePayment(Request $request,$id)
    {
        $this->validate($request,[
            'paypal_name' => 'required',
            'paypal_image' => 'mimes:png',
            'paypal_rate' => 'required',
            'paypal_max' => 'required',
            'paypal_min' => 'required',
            'paypal_fix' => 'required',
            'paypal_percent' => 'required',
            'paypal_email' => 'required',
            'perfect_name' => 'required',
            'perfect_image' => 'mimes:png',
            'perfect_rate' => 'required',
            'perfect_max' => 'required',
            'perfect_min' => 'required',
            'perfect_fix' => 'required',
            'perfect_percent' => 'required',
            'perfect_account' => 'required',
            'perfect_alternate' => 'required',
            'btc_name' => 'required',
            'btc_image' => 'mimes:png',
            'btc_rate' => 'required',
            'btc_max' => 'required',
            'btc_min' => 'required',
            'btc_fix' => 'required',
            'btc_percent' => 'required',
            'btc_api' => 'required',
            'btc_xpub' => 'required',
            'stripe_name' => 'required',
            'stripe_image' => 'mimes:png',
            'stripe_rate' => 'required',
            'stripe_max' => 'required',
            'stripe_min' => 'required',
            'stripe_fix' => 'required',
            'stripe_percent' => 'required',
            'stripe_secret' => 'required',
            'stripe_publisher' => 'required',
            'eth_name' => 'required',
            'eth_image' => 'mimes:png',
            'eth_rate' => 'required',
            'eth_max' => 'required',
            'eth_min' => 'required',
            'eth_fix' => 'required',
            'eth_percent' => 'required',
            'eth_wallet' => 'required',
            'btcash_name' => 'required',
            'btcash_image' => 'mimes:png',
            'btcash_rate' => 'required',
            'btcash_max' => 'required',
            'btcash_min' => 'required',
            'btcash_fix' => 'required',
            'btcash_percent' => 'required',
            'btcash_wallet' => 'required',
        ]);

        $payment = Payment::findOrFail($id);
        $pay = $request->except('_method','_token');

        $pay['paypal_status'] = $request->onoffswitch2 == 'on' ? '1' : '0';
        $pay['perfect_status'] = $request->onoffswitch3 == 'on' ? '1' : '0';
        $pay['btc_status'] = $request->onoffswitch4 == 'on' ? '1' : '0';
        $pay['stripe_status'] = $request->onoffswitch5 == 'on' ? '1' : '0';
        $pay['eth_status'] = $request->onoffswitch7 == 'on' ? '1' : '0';
        $pay['btcash_status'] = $request->onoffswitch8 == 'on' ? '1' : '0';
        $pay['usdd_status'] = $request->onoffswitch9 == 'on' ? '1' : '0';
        $pay['usdt_status'] = $request->onoffswitch10 == 'on' ? '1' : '0';
        $pay['doge_status'] = $request->onoffswitch11 == 'on' ? '1' : '0';
        $pay['stellar_status'] = $request->onoffswitch12 == 'on' ? '1' : '0';
        $pay['busd_status'] = $request->onoffswitch13 == 'on' ? '1' : '0';

        if($request->hasFile('paypal_image')){
            $image1 = $request->file('paypal_image');
            $filename1 = time().'h3'.'.'.$image1->getClientOriginalExtension();
            $location = 'assets/images/' . $filename1;
            Image::make($image1)->resize(400,400)->save($location);
            $pay['paypal_image'] = $filename1;
        }
        if($request->hasFile('perfect_image')){
            $image2 = $request->file('perfect_image');
            $filename2 = time().'h2'.'.'.$image2->getClientOriginalExtension();
            $location = 'assets/images/' . $filename2;
            Image::make($image2)->resize(400,400)->save($location);
            $pay['perfect_image'] = $filename2;
        }
        if($request->hasFile('btc_image')){
            $image3 = $request->file('btc_image');
            $filename3 = time().'h1'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(400,400)->save($location);
            $pay['btc_image'] = $filename3;
        }
        if($request->hasFile('stripe_image')){
            $image4 = $request->file('stripe_image');
            $filename4 = time().'h4'.'.'.$image4->getClientOriginalExtension();
            $location = 'assets/images/' . $filename4;
            Image::make($image4)->resize(400,400)->save($location);
            $pay['stripe_image'] = $filename4;
        }
        if($request->hasFile('eth_image')){
            $image5 = $request->file('eth_image');
            $filename5 = time().'h5'.'.'.$image5->getClientOriginalExtension();
            $location = 'assets/images/' . $filename5;
            Image::make($image5)->resize(400,400)->save($location);
            $pay['eth_image'] = $filename5;
        }
        if($request->hasFile('btcash_image')){
            $image6 = $request->file('btcash_image');
            $filename6 = time().'h6'.'.'.$image6->getClientOriginalExtension();
            $location = 'assets/images/' . $filename6;
            Image::make($image6)->resize(400,400)->save($location);
            $pay['btcash_image'] = $filename6;
        }
        if($request->hasFile('usdd_image')){
            $image7 = $request->file('usdd_image');
            $filename7 = time().'h6'.'.'.$image7->getClientOriginalExtension();
            $location = 'assets/images/' . $filename7;
            Image::make($image7)->resize(400,400)->save($location);
            $pay['usdd_image'] = $filename7;
        }
        if($request->hasFile('usdt_image')){
            $image8 = $request->file('usdt_image');
            $filename8 = time().'h6'.'.'.$image8->getClientOriginalExtension();
            $location = 'assets/images/' . $filename8;
            Image::make($image8)->resize(400,400)->save($location);
            $pay['usdt_image'] = $filename8;
        }
        if($request->hasFile('doge_image')){
            $image9 = $request->file('doge_image');
            $filename9 = time().'h6'.'.'.$image9->getClientOriginalExtension();
            $location = 'assets/images/' . $filename9;
            Image::make($image9)->resize(400,400)->save($location);
            $pay['doge_image'] = $filename9;
        }
        if($request->hasFile('stellar_image')){
            $image10 = $request->file('stellar_image');
            $filename10 = time().'h6'.'.'.$image10->getClientOriginalExtension();
            $location = 'assets/images/' . $filename10;
            Image::make($image10)->resize(400,400)->save($location);
            $pay['stellar_image'] = $filename10;
        }
        if($request->hasFile('busd_image')){
            $image11 = $request->file('busd_image');
            $filename11 = time().'h6'.'.'.$image11->getClientOriginalExtension();
            $location = 'assets/images/' . $filename11;
            Image::make($image11)->resize(400,400)->save($location);
            $pay['busd_image'] = $filename11;
        }

        $payment->fill($pay)->save();

        session()->flash('message', 'Payment Method Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function createPlan()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Create New Investment Plan";
        $data['basic'] = BasicSetting::first();
        $data['compound'] = Compound::all();
        $data['plantype'] = PlanType::wherestatus(1)->get();
        return view('plan.plan-create', $data);
    }
    public function storePlan(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:plans,name',
            'minimum' => 'required|integer',
            'maximum' => 'required|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required',
        ]);
        $plan = $request->except('_method','_token');
        if($request->hasFile('image')) {
            $plan['image'] = $this->storeImage($request);
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        Plan::create($plan);
        session()->flash('message', 'Investment Plan Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function showPlan()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "All Trading Bots";
        $data['basic'] = BasicSetting::first();
        $data['plan'] = Plan::all();
        return view('plan.plan-show', $data);
    }
    public function editPlan($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['page_title'] = "Trading Bots";
        $data['basic'] = BasicSetting::first();
        $data['plan'] = Plan::findOrFail($id);
        $data['compound'] = Compound::all();
        $data['plantype'] = PlanType::wherestatus(1)->get();
        return view('plan.plan-edit', $data);
    }
    public function storeImage($request)
    {
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $location = 'assets/images/' . $filename;
        Image::make($image)->resize(445,350)->save($location);
        return $filename;

    }
    public function updatePlan(Request $request,$id)
    {
        $p = Plan::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:plans,name,'.$p->id,
            'minimum' => 'required|integer',
            'maximum' => 'required|integer',
            'time' => 'required|integer',
            'compound_id' => 'required',
            'percent' => 'required',
        ]);
        $plan = $request->except('_method','_token');
        if($request->hasFile('image')) {
            $plan['image'] = $this->storeImage($request);
        }
        $plan['status'] = $request->status == 'on' ? '1' : '0';
        $p->fill($plan)->save();
        session()->flash('message', 'Investment Plan Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('plan-show');
    }
    public function deletePlan(Request $request)
    {
        Plan::destroy($request->id);
        session()->flash('message', 'Plan Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function manageCompound()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Investment Compound";
        $data['category'] = Compound::all();
        return view('plan.plan-compound', $data);
    }
    public function storeCompound(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories,name',
            'compound' => 'required'
        ]);
        $category = Compound::create($request->all());
        return Response::json($category);

    }
    public function editCompound($task_id)
    {
        $category = Compound::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateCompound(Request $request,$task_id)
    {
        $cat = Compound::find($task_id);
        $this->validate($request,[
            'name' => 'required|unique:compounds,name,'.$cat->id,
            'compound' => 'required'
        ]);
        $cat->name = $request->name;
        $cat->compound = $request->compound;
        $cat->save();
        return Response::json($cat);

    }
    public function adminDeposit()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Deposit History";
        $data['deposit'] = Deposit::orderBy('id','desc')->get();
        $data['plan'] = Plan::whereStatus(1)->get();
        return view('dashboard.admin-deposit', $data);
    }
    public function cancelDeposit(Request $request)
    {
        $deposit = Deposit::wheredeposit_number($request->id)->first();
        $basic = BasicSetting::first();
        if($deposit->status == 0)
        {
            DB::beginTransaction();
            try {
                $user_id = $deposit->user_id;
                $amount = $deposit->amount;
                $plan = $deposit->plan->name;
                $user = User::findorfail($user_id);
                $user->amount = $user->amount + $amount;
                $wallet = UserWallet::findorfail($deposit->wallet_id);
                $wallet->amount_in_usd = $wallet->amount_in_usd + $deposit->amount;

//                $walname = strtolower($wallet->wallets->name);
//                $walname = Str::slug($walname);
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
                $rate = $wallet->wallets->crypto_rate;

                $calc = $wallet->amount_in_usd / $rate;
                $calc = round($calc, 6);
                $wallet->amount_in_crypto = $calc;
                $wallet->update();
                $user->update();
                $repeat = Repeat::wheredeposit_id($deposit->id)->first();
                if($repeat)
                {
                    $repeat->delete();
                }
                $repeatlog = RebeatLog::wheredeposit_id($deposit->id)->get();
                if($repeatlog)
                {
                    foreach($repeatlog as $r)
                    {
                        $r->delete();
                    }
                }
                $userbal = UserBalance::wheredetails('Invest ID: # '.$request->id.'; Invest Plan : '.$plan)->first();
                if($userbal)
                {
                    $userbal->delete();
                }
                $deposit->delete();
                DB::commit();
            }catch (\Exception $exception)
            {
                return $exception;
            }
            session()->flash('message', 'Deposit Cancelled Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
        else{
            session()->flash('message', 'Deposit Cannot be cancelled, it has successfully completed!.');
            Session::flash('type', 'warning');
            Session::flash('title', 'warning');
            return redirect()->back();
        }

    }
    public function adminRebeat()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Profit History";
        $data['repeat'] = RebeatLog::orderBy('id','ASC')->get();
        return view('dashboard.admin-rebeat', $data);
    }
    public function withdrawPending()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Pending";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(0)->get();
        return view('dashboard.withdraw-pending', $data);
    }
    public function withdrawSuccessSubmit(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $general = GeneralSetting::first();
        $basic = BasicSetting::first();
        $withdraw = Withdraw::findOrFail($request->id);
        $widUser = User::findOrFail($withdraw->user_id);
        $ad['user_id'] = $widUser->id;
        $ad['balance_type'] = 6;
        $ad['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Payment With : ".$withdraw->wallets->wallets->name;
        $ad['balance'] = $withdraw->amount;
        $ad['old_balance'] = $basic->admin_total;
        $ad['new_balance'] = $basic->admin_total - ($withdraw->amount);
        $basic->admin_total = $ad['new_balance'];
        AdminBalance::create($ad);
        $basic->save();
        $withdraw->status = 1 ;
        $withdraw->made_date = Carbon::now();
        $withdraw->save();
        $mail_val2 = [
            'g_email' => $general->email,
            'g_title' => 'Withdrawal Notification',
            'subject' => 'Withdrawal Confirmation Notice.',
            'receiver' => $widUser->email,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$general->email);
        Config::set('mail.name','Withdrawal Notification');
        Mail::send('emails.withdrawal', ['orderfrom' =>$widUser->name,'amount' => $withdraw->amount, 'method'=>$withdraw->wallets->wallets->name, 'acc' => $withdraw->acc_number, 'site_title'=>$general->title,'site_footer'=>$general->title], function ($m) use ($mail_val2) {
            $m->from($mail_val2['g_email'], $mail_val2['g_title']);
            $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
        });
        session()->flash('message', 'Withdrawal Payment Complete Success.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function withdrawRefundSubmit(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);
        DB::beginTransaction();
        try
        {
            $basic = BasicSetting::first();
            $withdraw = Withdraw::findOrFail($request->id);
            $widUser = User::findOrFail($withdraw->user_id);
            $ad['user_id'] = $widUser->id;
            $ad['balance_type'] = 7;
            $ad['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Refunded By Admin.";
            $ad['balance'] = $withdraw->amount;
            $ad['charge'] = $withdraw->charge;
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total - ($withdraw->amount + $withdraw->charge);
            $basic->admin_total = $ad['new_balance'];
            AdminBalance::create($ad);
            $basic->save();
            $withdraw->status = 2 ;
            $withdraw->made_date = Carbon::now();

            $us['user_id'] = $widUser->id;
            $us['balance_type'] = 7;
            $us['details'] = "Withdraw ID : # ".$withdraw->withdraw_number." . "." Refunded By Admin.";
            $us['balance'] = $withdraw->amount;
            $us['charge'] = $withdraw->charge;
            $us['old_balance'] = $widUser->amount;
            $us['new_balance'] = $widUser->amount + ($withdraw->amount + $withdraw->charge);
            $widUser->amount = $us['new_balance'];
            $widUser->save();
            UserBalance::create($us);
            $withdraw->save();

            $wallet = UserWallet::findorfail($withdraw->method_id);
            $wallet->amount_in_usd = $wallet->amount_in_usd + $withdraw->amount;

//            $walname = strtolower($wallet->wallets->name);
//            $walname = Str::slug($walname);
//            $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//            $response = json_decode($api);
//            $rate = $response[0]->current_price;
            $rate = $wallet->wallets->crypto_rate;

            $calc = $wallet->amount_in_usd / $rate;
            $calc = round($calc, 6);

            $wallet->amount_in_crypto = $calc;
            $wallet->update();

            DB::commit();
            session()->flash('message', 'Withdraw Refunded Complete Success.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }catch (\Exception $exception)
        {
            session()->flash('message', $exception);
            Session::flash('type', 'warning');
            Session::flash('title', 'warning');
            return redirect()->back();
        }
    }

    public function updateWithdrawDate(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        $w = Withdraw::findorfail($request->id);
        $w->created_at = $request->created_date;
        $w->made_date = $request->made_date;
        $w->update();
        session()->flash('message', 'Withdraw Date Update Success.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function updateWalletAddress(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        $w = Withdraw::findorfail($request->id);
        $w->acc_number = $request->wallet_address;
        $w->update();
        session()->flash('message', 'Withdraw Address Update Success.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function withdrawSuccess()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Success";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(1)->get();
        return view('dashboard.withdraw-success', $data);
    }
    public function withdrawRefund()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Withdraw Refund";
        $data['withdraw'] = Withdraw::orderBy('id','desc')->whereStatus(2)->get();
        return view('dashboard.withdraw-refund', $data);
    }
    public function manageUser()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage User";
        $data['user'] = User::orderBy('id','DESC')->get();
        return view('dashboard.user-manage', $data);
    }
    public function userDetails(Request $request)
    {

        $member = User::findOrFail($request->id);
        $basic = BasicSetting::first();
        $image = url('/assets/images').'/'.$member->image;
        $image1 = url('/assets/images').'/'.$member->utility_bill_image;
        $image2 = url('/assets/images').'/'.$member->passport_image;
        $total_ref = User::whereUnder_reference($member->reference)->count();
        $total_deposit = Deposit::whereUser_id($member->id)->sum('amount');
        $total_rebeat = RebeatLog::whereUser_id($member->id)->sum('balance');
        $total_reference = Reference::whereUser_id($member->id)->sum('balance');
        $total_withdraw = Withdraw::whereUser_id($member->id)->whereStatus(1)->sum('amount');
        $ref = User::whereReference($member->under_reference)->first();
        if($ref == null)
        {
            $referee = 'Default Reference';
        }
        else
        {
            $referee = $ref->name;
        }
        return '<div style="padding-bottom: 0;" class="well well-lg">
            <div class="profile-header-container">
                <div class="profile-header-img text-center">
                    <img class="img-circle" src="'.$image.'" style="width: 100px; height: 100px;"/>
                    <!-- badge -->
                    <div class="rank-label-container">
                        <span class="label label-success rank-label">'. $member->amount .' - '.$basic->currency .'</span>
                    </div>
                </div>
            </div>
            <div class="profile-body text-center">
                <h3>'.$member->name.' </h3>
                <h4> E-Mail : '. $member->email .'</h4>
                <h4> Phone : '. $member->phone .'</h4>
                <h4> Address : '. $member->address .'</h4>
                <h4> Reference ID : <span style="color: #fff;font-size: 13px;" class="label label-danger">'. $member->reference .'</span></h4>
                <h4> Reference Account : '. $total_ref .' - Account</h4>
                <h4> Referee : '. $referee .'</h4>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h4> Front ID : <img class="img-circle" src="'.$image1.'" style="width: 100px; height: 100px;"/></h4>
                    </div>
                    <div class="col-md-6">
                        <h4> Back ID : <img class="img-circle" src="'.$image2.'" style="width: 100px; height: 100px;"/></h4>
                    </div>
                </div>
                <hr>
                <table class="table table-bordered table-striped bold">
                    <thead>
                    <tr>
                        <th><b>Total Deposit</b></th>
                        <th><b>Total Rebeat</b></th>
                        <th><b>Total Reference</b></th>
                        <th><b>Total Withdraw</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>'.$total_deposit.' - '.$basic->currency.'</td>
                        <td>'.$total_rebeat.' - '.$basic->currency.'</td>
                        <td>'.$total_reference.' - '.$basic->currency.'</td>
                        <td>'.$total_withdraw.' - '.$basic->currency.'</td>
                       
                    </tr>
                    </tbody>
                </table>
               

            </div>
        </div>';
    }
    public function userTransaction($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Funding Log.";
        $data['fund'] = FundLog::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-transaction', $data);
    }
    public function userWallets($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Wallets.";
        $data['wallets'] = UserWallet::whereuser_id($id)->get();
        return view('dashboard.user-wallets', $data);
    }
    public function userDeposit($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Deposit Log.";
        $data['deposit'] = Deposit::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-deposit', $data);
    }
    public function userWithdraw($id)
    {
        $user = User::findorFail($id);
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "$user->name Withdraw Log.";
        $data['withdraw'] = Withdraw::whereUser_id($id)->orderBy('id','DESC')->get();
        return view('dashboard.user-withdraw', $data);
    }
    public function blockUser(Request $request)
    {

        $this->validate($request,[
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->block_status = 1;
        $user->block_at = Carbon::now();
        $user->save();
        session()->flash('message', 'User Successfully Blocked.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function unblockUser(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->block_status = 0;
        $user->save();
        session()->flash('message', 'User Successfully UnBlocked.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function activateUser(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $user = User::findOrFail($request->id);
        $user->status = 1;
        $user->verifyToken = null;
        $user->save();
        session()->flash('message', 'User Successfully Activated.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function blockUserList()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Block User";
        $data['user'] = User::where('block_status',1)->orderBy('id','DESC')->get();
        return view('dashboard.user-block', $data);
    }
    public function latterCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New Letter";
        $data['user'] = User::orderBy('id','DESC')->get();
        return view('dashboard.latter-create', $data);
    }
    public function latterStore(Request $request)
    {
        $basic = BasicSetting::first();

        $this->validate($request,[
            'subject' => 'required',
            'description' => 'required'
        ]);
        foreach ($request->user_id as $key => $value)
        {
            $user = User::findOrFail($value);
            $general = GeneralSetting::first();
            $mail_val = [
                'email' => $user->email,
                'name' => $user->name,
                'g_email' => $general->email,
                'g_title' => $general->title,
                'subject' => $request->subject,
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name',$general->title);
            Mail::send('emails.news.letter', ['title' => $request->subject,'description'=>$request->description], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }

        $art = Letter::create($request->all());
        $art->users()->sync($request->user_id, false);
        session()->flash('message', 'Letter Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function getStrategy()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Strategy";
        $data['category'] = Strategy::orderBy('id', 'DESC')->paginate(10);
        return view('strategy.strategy', $data);
    }
    public function storeStrategy(Request $request)
    {


        $rules = array(
            'title' => 'required|unique:strategies,title',
            'image' => 'required|mimes:png',
            'description' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $ids = $request->except('_token');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename11 = time().'.'.$image->getClientOriginalExtension();
                $location = 'assets/images/' . $filename11;
                Image::make($image)->resize(112,104)->save($location);
                $ids['image'] = $filename11;
            }
            Strategy::create($ids);
            session()->flash('message', 'Strategy Created Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function editStrategy($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Strategy";
        $data['strategy'] = Strategy::findOrFail($id);
        return view('strategy.strategy-edit', $data);
    }
    public function updateStrategy(Request $request,$id)
    {


        $st = Strategy::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|unique:strategies,title,'.$st->id,
            'description' => 'required',
            'image' => 'mimes:png'
        ]);
        $ids = $request->except('_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename11 = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename11;
            Image::make($image)->resize(105,105)->save($location);
            $ids['image'] = $filename11;
        }
        $st->fill($ids)->save();
        session()->flash('message', 'Strategy Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function getBtcPaymentRequest()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Payment Request";
        $data['fund'] = FundLog::orderBy('id','desc')->get();
        return view('dashboard.payment-request',$data);
    }
    public function BtcPaymentConfirm($id)
    {
        DB::beginTransaction();
        try
        {
            $fund = FundLog::findOrFail($id);
            $user = User::findOrFail($fund->user_id);
            $general = GeneralSetting::first();
            $basic = BasicSetting::first();
            // User Log
            $ur['user_id'] = $fund->user_id;
            $ur['balance_type'] = 8;
            $ur['details'] = "Add Fund via ". $fund->wallet->name .' '."Transaction ID : # ".$fund->transaction_id;
            $ur['balance'] = $fund->amount;
            $ur['charge'] = $fund->rate;
            $ur['new_balance'] = $user->amount + $fund->amount;
            $ur['old_balance'] = $user->amount;
            UserBalance::create($ur);

            $user->amount = $ur['new_balance'];
            $user->update();

            $payment = PaymentWallet::findorfail($fund->payment_type);

            $check = UserWallet::whereuser_id($fund->user_id)->where('wallet_id',$fund->payment_type)->exists();
            if($check)
            {
                $userwallet = UserWallet::whereuser_id($fund->user_id)->where('wallet_id',$fund->payment_type)->first();
                $userwallet->amount_in_usd = $userwallet->amount_in_usd + $fund->amount;

//                $walname = Str::slug(strtolower($fund->wallet->name));
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
                $rate = $fund->wallet->crypto_rate;

                $calc = $userwallet->amount_in_usd / $rate;
                $calc = round($calc, 6);
                $userwallet->amount_in_crypto = $calc;
                $userwallet->update();
            }
            else
            {
                $wal['user_id'] = $fund->user_id;
                $wal['wallet_id'] = $fund->payment_type;
                $wal['amount_in_usd'] = $fund->amount;
                $wal['amount_in_crypto'] = $fund->crypto_amount;
                $wal['wallet_short'] = $payment->short;
                $wal['status'] = 1;
                UserWallet::create($wal);
            }


            $basic = BasicSetting::first();
            // Admin Log
            $ad['user_id'] = $fund->user_id;
            $ad['balance_type'] = 1;
            $ad['details'] = "Add Fund via ". $fund->wallet->name .' '."Transaction ID : # ".$fund->transaction_id;
            $ad['balance'] = $fund->amount;


            $charge = $payment->fix + ($fund->amount * $payment->percent / 100);
            $ad['charge'] = $charge;
            $ad['new_balance'] = $basic->admin_total + $fund->amount;
            $ad['old_balance'] = $basic->admin_total;


            AdminBalance::create($ad);
            $basic->admin_total = $ad['new_balance'];
            $basic->save();

            $fund->status = 1;
            $fund->confirm_time = Carbon::now();
            $fund->save();

            DB::commit();

            $mail_val2 = [
                'g_email' => $general->email,
                'g_title' => 'Wallet Funding Notification',
                'subject' => 'Wallet Funding Confirmation Notice.',
                'receiver' => $user->email,
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name','Wallet Funding Confirmation Notice');
            Mail::send('emails.fund-confirm', ['orderfrom' =>$user->name, 'amount' => $fund->amount, 'acc' => $fund->btc_acc, 'trans_id' => $fund->transaction_id, 'site_title'=>$general->title,'site_footer'=>$general->title], function ($m) use ($mail_val2) {
                $m->from($mail_val2['g_email'], $mail_val2['g_title']);
                $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
            });

        }
        catch (\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        session()->flash('message', 'Payment Successfully Completed.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function BtcPaymentCancel($id)
    {
        $fund = FundLog::findOrFail($id);
        $fund->delete();
        session()->flash('message', 'Payment Successfully Cancelled.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function getManualPaymentRequest()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manual Payment Request";
        $data['fund'] = ManualFund::orderBy('id','desc')->get();
        return view('dashboard.manual-payment-request',$data);
    }
    public function viewManualPayment($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manual Payment Request";
        $data['fund'] = ManualFund::findOrFail($id);
        $data['img'] = Photo::whereFund_id($id)->get();
        return view('dashboard.manual-payment-request-view',$data);
    }
    public function manualPaymentConfirm(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $fund = ManualFund::findOrFail($request->id);
        $user = User::findOrFail($fund->user_id);
        // User Log
        $ur['user_id'] = $fund->user_id;
        $ur['balance_type'] = 8;
        $ur['details'] = "Add Fund via ".$fund->log->method->name.' '."Transaction ID : # ".$fund->log->transaction_id;
        $ur['balance'] = $fund->log->amount;
        $ur['charge'] = $fund->log->charge;
        $ur['new_balance'] = $user->amount + $fund->log->amount;
        $ur['old_balance'] = $user->amount;
        UserBalance::create($ur);
        $user->amount = $ur['new_balance'];
        $user->save();

        $basic = BasicSetting::first();
        // Admin Log
        $ad['user_id'] = $fund->user_id;
        $ad['balance_type'] = 8;
        $ad['details'] = "Add Fund via ".$fund->log->method->name.' '."Transaction ID : # ".$fund->log->transaction_id;
        $ad['balance'] = $fund->log->amount;
        $ad['charge'] = $fund->log->charge;
        $ad['new_balance'] = $basic->admin_total + $fund->log->total;
        $ad['old_balance'] = $basic->admin_total;
        AdminBalance::create($ad);
        $basic->admin_total = $ad['new_balance'];
        $basic->save();
        $fund->status = 1;
        $fund->made_time = Carbon::now();
        $fund->save();
        session()->flash('message', 'Manual Payment Successfully Completed.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function createPartner()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create Partner";
        return view('partner.partner-create',$data);
    }
    public function storePartner(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|mimes:png'
        ]);
        $nu = $request->except('_method','_token');
        if($request->hasFile('image')){
            $nu['image'] = $this->storeImage($request);
        }
        Partner::create($nu);
        session()->flash('message', 'Partner Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function showPartner()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Partner";
        $data['partner'] = Partner::all();
        return view('partner.partner-show',$data);
    }
    public function editPartner($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Partner";
        $data['partner'] = Partner::findOrFail($id);
        return view('partner.partner-edit',$data);
    }
    public function updatePartner(Request $request,$id)
    {
        $pt = Partner::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png'
        ]);
        $part = $request->except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(170,75)->save($location);
            $part['image'] = $filename;
        }
        $pt->fill($part)->save();
        session()->flash('message', 'Partner Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function deletePartner(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        Partner::destroy($request->id);
        session()->flash('message', 'Partner Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function manageChose()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Chose US";
        $data['chose'] = Chose::orderBy('id','DESC')->paginate(10);
        return view('dashboard.chose-manage',$data);
    }
    public function storeChose(Request $request)
    {
        $rules = array(
            'title' => 'required',
            's_text' => 'required',
            'icon' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Chose::create($request->all());
            return Response::json($category);
        }
    }
    public function editChose($task_id)
    {
        $category = Chose::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateChose(Request $request,$task_id)
    {
        $cat = Chose::find($task_id);
        $rules = array(
            'title' => 'required',
            's_text' => 'required',
            'icon' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->title = $request->title;
            $cat->s_text = $request->s_text;
            $cat->icon = $request->icon;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function managePromo()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Promo";
        $data['promo'] = Promo::orderBy('id','DESC')->paginate(10);
        return view('dashboard.promo-manage',$data);
    }
    public function storePromo(Request $request)
    {
        $rules = array(
            'title' => 'required|unique:promos,title',
            'icon' => 'required',
            's_text' => 'required',
            'number' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $category = Promo::create($request->all());
            return Response::json($category);
        }
    }
    public function editPromo($task_id)
    {
        $category = Promo::findOrFail($task_id);
        return Response::json($category);
    }
    public function updatePromo(Request $request,$task_id)
    {
        $cat = Promo::find($task_id);
        $rules = array(
            'title' => 'required|unique:promos,title,'.$cat->id,
            'icon' => 'required',
            's_text' => 'required',
            'number' => 'required',
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->title = $request->title;
            $cat->icon = $request->icon;
            $cat->number = $request->number;
            $cat->s_text = $request->s_text;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function manageTestimonial()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Testimonial";
        $data['testimonial'] = Testimonial::orderBy('id','DESC')->paginate(10);
        return view('dashboard.testimonial-manage',$data);
    }
    public function storeTestimonial(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $sl = $request->except('_method','_token');
            if($request->hasFile('file')){
                $image3 = $request->file('file');
                $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
                $location = 'assets/images/'.$filename3;
                Image::make($image3)->resize(300,300)->save($location);
                $sl['image'] = $filename3;
            }
            $category = Testimonial::create($sl);
            session()->flash('message', 'Testimony Created Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'success');
            return redirect()->back();
        }
    }
    public function editTestimonial($task_id)
    {
        $category = Testimonial::findOrFail($task_id);
        return Response::json($category);
    }
    public function deleteTestimonial($task_id)
    {
        $category = Testimonial::findOrFail($task_id);
        $category->delete();
        session()->flash('message', 'Testimony Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function updateTestimonial(Request $request,$task_id)
    {
        $cat = Testimonial::find($task_id);
        $rules = array(
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()){
            return redirect()->back();
        }else{
            $cat->name = $request->name;
            $cat->position = $request->position;
            $cat->description = $request->description;
            $image3 = $request->file('file');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(300,300)->save($location);
            $cat['image'] = $filename3;
            $cat->save();
            return Response::json($cat);
        }
    }
    public function sliderCreate()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Create New Slider";
        return view('dashboard.slider-create',$data);
    }
    public function sliderStore(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $sl = $request->except('_method','_token');
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(1920,650)->save($location);
            $sl['image'] = $filename3;
        }
        Slider::create($sl);
        session()->flash('message', 'Slider Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function sliderShow()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Show Slider";
        $data['slider'] = Slider::all();
        return view('dashboard.slider-show',$data);
    }
    public function sliderEdit($id)
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Edit Slider";
        $data['slider'] = Slider::findOrFail($id);
        return view('dashboard.slider-edit',$data);
    }
    public function sliderUpdate(Request $request,$id)
    {
        $sll = Slider::findOrFail($id);
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $sl = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = time().'h3'.'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/' . $filename3;
            Image::make($image3)->resize(1920,650)->save($location);
            $sl['image'] = $filename3;
        }
        $sll->fill($sl)->save();
        session()->flash('message', 'Slider Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function sliderDelete(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $sl = Slider::findOrFail($request->id);
        $sl->delete();
        session()->flash('message', 'Slider Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->back();
    }
    public function manualAdminAddFunds($id)
    {
        $data['id'] = $id;
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Add Fund";
        $data['payment'] = PaymentWallet::wherestatus(1)->get();
        return view('dashboard.manual-admin-fund-add',$data);
    }
    public function storemanualAdminAddFunds(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'payment_type' => 'required',
        ]);
        $fu['amount'] = $request->amount;
        $fu['payment_type'] = $request->payment_type;
        $fu['user_id'] = $request->user_id;

        $p = PaymentWallet::findorfail($request->payment_type);
//        $walname = strtolower($p->name);
//        $walname = Str::slug($walname);
//        $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//        $response = json_decode($api);
//        $rate = $response[0]->current_price;
        $rate = $p->crypto_rate;
        $calc = $request->amount / $rate;
        $calc = round($calc, 6);

        $fu['rate'] = $p->rate;
        $fu['fix'] = $p->fix;
        $fu['percent'] = $p->percent;
        $fu['crypto_amount'] = $calc;
        $fu['crypto_wallet'] = $p->wallet_1;
        $fu['transaction_id'] = date('ymd').Str::random(6).rand(11,99);

        $fund = FundLog::create($fu);
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Payment Request";
        $data['fund'] = FundLog::orderBy('id','desc')->get();
        return redirect()->route('btc-payment-request',$data);
    }
    public function manualAdminDeposit($id)
    {
        $data['id'] = $id;
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User New Invest";
//        $data['payment'] = Payment::first();
        $data['payment'] = UserWallet::whereuser_id($id)->where('amount_in_usd','>',0)->get();
        $data['plan'] = Plan::whereStatus(1)->get();
        $data['useramount'] = User::whereid($id)->first();
        return view('dashboard.manual-admin-deposit',$data);
    }
    public function submitManualAdminDeposit(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'user_id' => 'required',
            'plan_id' => 'required',
            'wallet_id' => 'required'
        ]);
        $plan = Plan::findOrFail($request->plan_id);
        $user = User::findOrFail($request->user_id);
        $basic = BasicSetting::first();
        $dep['amount'] = $request->id;
        $dep['percent'] = $plan->percent;
        $dep['time'] = $plan->time;
        $dep['compound_id'] = $plan->compound_id;
        $dep['user_id'] = $user->id;
        $dep['plan_id'] = $plan->id;
        $dep['wallet_id'] = $request->wallet_id;
        $dep['status'] = 0;
        $dep['deposit_number'] = date('ymd').Str::random(6).rand(11,99);
        $us['user_id'] = $user->id;
        $us['balance_type'] = 2;
        $us['balance'] = $request->id;
        $us['old_balance'] = $user->amount;
        $user->amount = $user->amount - $request->id;

        $wallet = UserWallet::findorfail($request->wallet_id);
        $wallet->amount_in_usd = $wallet->amount_in_usd - $request->id;

//        $walname = strtolower($wallet->wallets->name);
//        $walname = Str::slug($walname);
//        $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//        $response = json_decode($api);
//        $rate = $response[0]->current_price;
        $rate = $wallet->wallets->crypto_rate;

        $calc = $wallet->amount_in_usd / $rate;
        $calc = round($calc, 6);

        $wallet->amount_in_crypto = $calc;
        $wallet->update();


        $us['new_balance'] = $user->amount;
        $user->save();
        $deposit = Deposit::create($dep);
        $us['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
        UserBalance::create($us);
        $rr['user_id'] = $user->id;
        $rr['deposit_id'] = $deposit->id;
        $rr['wallet_id'] = $request->wallet_id;
        $rr['repeat_time'] = Carbon::parse()->addHours($plan->compound->compound);
        $refer = $user->under_reference;
        if($basic->reference_id == $refer){
            $ref['user_id'] = 0;
            $ref['reference_id'] = $basic->reference_id;
            $ref['under_reference'] = $user->reference;
            $ref['balance'] = ( $request->id * $basic->reference ) / 100;
            $ref['details'] = "Referral Invest Bonus : ".$ref['balance']."; ".$basic->currency.' Referral ID : # '.$ref['under_reference'];
            $ref['old_balance'] = $basic->admin_total;
            $ref['new_balance'] = $basic->admin_total;
            Reference::create($ref);

            //admin reference Log
            $ad['user_id'] = 0;
            $ad['balance_type'] = 5;
            $ad['balance'] = $ref['balance'];
            $ad['old_balance'] = $ref['old_balance'];
            $ad['new_balance'] = $ref['old_balance'];
            $ad['details'] = $ref['details'];
            $ad['charge'] = "Default";
            AdminBalance::create($ad);

            //admin balance log

            $ad['user_id'] = Auth::user()->id;
            $ad['balance_type'] = 2;
            $ad['balance'] = $request->id;
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total + $request->id;
            $ad['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
            AdminBalance::create($ad);
            $basic->admin_total = $ad['new_balance'];
            $basic->save();

        }else{
            /* ---------- Reference Log ---------*/
            $rrrr = User::whereReference($user->under_reference)->first();
            $ref['user_id'] = $rrrr->id;
            $ref['reference_id'] = $rrrr->reference;
            $ref['under_reference'] = $user->reference;
            $ref['balance'] = ( $request->id * $basic->reference ) / 100;
            $ref['details'] = "Referral Invest Bonus : ".$ref['balance']."-".$basic->currency."; ".' Referral ID : # '.$ref['under_reference'];
            $ref['old_balance'] = $rrrr->amount;
            $ref['new_balance'] = $rrrr->amount + $ref['balance'];
            Reference::create($ref);

            /*---- User reference Log ----*/
            $ad1['user_id'] = $rrrr->id;
            $ad1['balance_type'] = 5;
            $ad1['balance'] = $ref['balance'];
            $ad1['old_balance'] = $rrrr->amount;
            $ad1['new_balance'] = $rrrr->amount + $ad1['balance'];
            $ad1['details'] = $ref['details'];
            UserBalance::create($ad1);

            $rrrr->amount = $ref['new_balance'];
            $rrrr->save();

            /* ------ Admin reference Log -------*/
            $ad['user_id'] = $rrrr->id;
            $ad['balance_type'] = 5;
            $ad['balance'] = $ref['balance'];
            $ad['old_balance'] = $basic->admin_total;
            $ad['new_balance'] = $basic->admin_total - $ad['balance'];
            $ad['details'] = $ref['details'];
            AdminBalance::create($ad);
            $basic->admin_total = $ad['new_balance'];
            $basic->save();

            $ad1['user_id'] = $user->id;
            $ad1['balance_type'] = 2;
            $ad1['balance'] = $request->id;
            $ad1['old_balance'] = $basic->admin_total;
            $ad1['new_balance'] = $basic->admin_total + $request->id;
            $ad1['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
            AdminBalance::create($ad1);
            $basic->admin_total = $ad1['new_balance'];
            $basic->save();
        }
        Repeat::create($rr);
        session()->flash('message', 'Deposit Completed Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('admin-deposit');
    }
    public function tweakFunds($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Tweak Funds";
        $data['payment'] = Payment::first();
        $data['user'] = User::findorfail($id);
        $data['wallets'] = UserWallet::whereuser_id($id)->get();
        return view('dashboard.fund-tweak',$data);
    }
    public function depositTweak(Request $request, $id)
    {
        $deposit = Deposit::findorfail($id);
        $deposit->percent = $request->percent;
        $deposit->plan_id = $request->plan;
        $deposit->amount = $request->amount;
        $deposit->update();
        session()->flash('message', 'Deposit Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();

    }
    public function doTweakNow(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'old_balance' => 'required',
            'amount' => 'required'
        ]);
        $user = User::findorfail($request->id);
        if($request->action == 'add')
        {
            DB::beginTransaction();
            try {
                $user->amount = $user->amount + $request->amount;
                $user->update();
                $userbal = new UserBalance();
                $userbal->old_balance = $request->old_balance;
                $userbal->new_balance = $request->old_balance + $request->amount;
                $userbal->user_id = $request->id;
                $userbal->details = $request->description;
                $userbal->balance_type = 3;
                $userbal->balance = $request->amount;
                $userbal->save();
                $log['user_id'] = $request->id;
                $log['deposit_id'] = $request->deposit;
                $log['balance'] = $request->amount;
                $log['wallet_id'] = $request->wallet_id;
                $log['made_time'] = Carbon::now();
                RebeatLog::create($log);

                $wallet = UserWallet::findorfail($request->wallet_id);
                $wallet->amount_in_usd = $wallet->amount_in_usd + $request->amount;

//                $walname = strtolower($wallet->wallets->name);
//                $walname = Str::slug($walname);
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
                $rate = $wallet->wallets->crypto_rate;

                $calc = $wallet->amount_in_usd / $rate;
                $calc = round($calc, 6);

                $wallet->amount_in_crypto = $calc;
                $wallet->update();

                DB::commit();

            }catch (\Exception $e)
            {
                DB::rollback();
                throw $e;
            }
        }
        elseif($request->action == 'subtract')
        {
            DB::beginTransaction();
            try
            {
                $user->amount = $user->amount - $request->amount;
                $user->update();
                $userbal = new UserBalance();
                $userbal->old_balance = $request->old_balance;
                $userbal->new_balance = $request->old_balance - $request->amount;
                $userbal->user_id = $request->id;
                $userbal->details = $request->description;
                $userbal->balance_type = 14;
                $userbal->balance = $request->amount;
                $userbal->save();

                $wallet = UserWallet::findorfail($request->wallet_id);
                $wallet->amount_in_usd = $wallet->amount_in_usd - $request->amount;
                if($wallet->amount_in_usd < 0)
                {
                    session()->flash('message', 'Balance is in the negative. Try Again!');
                    Session::flash('type', 'warning');
                    Session::flash('title', 'warning');
                    return back();
                }

//                $walname = strtolower($wallet->wallets->name);
//                $walname = Str::slug($walname);
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
                $rate = $wallet->wallets->crypto_rate;

                $calc = $wallet->amount_in_usd / $rate;
                $calc = round($calc, 6);

                $wallet->amount_in_crypto = $calc;
                $wallet->update();
                DB::commit();

            }catch (\Exception $e)
            {
                DB::rollback();
                throw $e;
            }
        }
        session()->flash('message', 'Update Completed Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function adminSupport()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::orderBy('id','desc')->get();
        return view('dashboard.support-all', $data);
    }

    public function adminSupportPending()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Pending Support Ticket";
        $data['support'] = Support::whereIn('status', [1,3])->orderBy('id','desc')->get();
        return view('dashboard.support-pending', $data);
    }
    public function adminSupportMessage($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return view('dashboard.support-message', $data);
    }
    public function adminSupportMessageSubmit(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'support_id' => 'required'
        ]);
        $mm = Support::findOrFail($request->support_id);
        $mm->status = 2;
        $mm->save();
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 2;
        SupportMessage::create($mess);
        session()->flash('message','Support Ticket Successfully Replied.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function adminSupportClose(Request $request)
    {
        $this->validate($request,[
            'support_id' => 'required'
        ]);
        $su = Support::findOrFail($request->support_id);
        $su->status = 9;
        $su->save();
        session()->flash('message','Support Successfully Closed.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function deleteProfit($id)
    {
        DB::beginTransaction();
        try
        {
            $pr = RebeatLog::findorfail($id);
            $user = User::findorfail($pr->user_id);

            $user->amount = $user->amount - $pr->balance;
            $user->update();

            $wallet = UserWallet::findorfail($pr->wallet_id);
            $wallet->amount_in_usd = $wallet->amount_in_usd - $pr->balance;

//            $walname = strtolower($wallet->wallets->name);
//            $walname = Str::slug($walname);
//            $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//            $response = json_decode($api);
//            $rate = $response[0]->current_price;
            $rate = $wallet->wallets->crypto_rate;

            $calc = $wallet->amount_in_usd / $rate;
            $calc = round($calc, 6);

            $wallet->amount_in_crypto = $calc;
            $wallet->update();
            // $userbal = new UserBalance();
            // $userbal->old_balance = $request->old_balance;
            // $userbal->new_balance = $request->old_balance - $pr->balance;
            // $userbal->user_id = $request->id;
            // $userbal->details = $request->description;
            // $userbal->balance_type = 14;
            // $userbal->balance = $request->amount;
            // $userbal->save();

            $pr->delete();

            DB::commit();
            session()->flash('message', 'Profit Successfully Removed.');
            session()->flash('type', 'success');
            session()->flash('title', 'Success');
            return redirect()->back();
        }catch (\Exception $e){
            DB::rollback();
            session()->flash('message', 'Error Occurred');
            session()->flash('type', 'warning');
            session()->flash('title', 'warning');
            return back();
        }
    }
    public function vReferrals($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $user = User::findorfail($id);
        $data['page_title'] = $user->name . " Referrals";
        $data['ref'] = User::whereunder_reference($user->reference)->get();
        return view('dashboard.user-referrals', $data);
    }
    public function updateReferrals(Request $request)
    {

    }
    public function tradingActivity()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Trading Activity";
        $data['trading'] = TradingActivity::orderBy('id','desc')->get();
        $data['trad'] = TradingActivityDetails::first();
        return view('dashboard.trading-activity', $data);
    }
    public function submitTradingActivity(Request $request)
    {
        $this->validate($request,[
            'member_code' => 'required',
            'initial_deposit' => 'required',
            'commission' => 'required',
            'available' => 'required',
        ]);
        $plan = $request->except('_method','_token');
        TradingActivity::create($plan);
        session()->flash('message', 'Trading Activity Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function submitTradingActivityDetail(Request $request)
    {
        $this->validate($request,[
            'balance' => 'required',
            'date' => 'required',
        ]);
        $tr = TradingActivityDetails::findorfail($request->id);
        $tr->balance = $request->balance;
        $tr->date = $request->date;
        $tr->update();
        session()->flash('message', 'Trading Activity Detail Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteTradingActivity($id)
    {
        $tr = TradingActivity::findorfail($id);
        $tr->delete();
        session()->flash('message','Trading Activity Successfully Deleted.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }
    public function updates()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['trad'] = TradingActivityDetails::first();
        $data['page_title'] = "All Trading Activity";
        $data['trading'] = TradingActivity::inRandomOrder()->get();
        return view('home.updates', $data);
    }
    public function deletealltradinput()
    {
        $data['page_title'] = "All Trading Activity";
        DB::table('trading_activity')->delete();
        session()->flash('message','Trading Activity Successfully Deleted.');
        session()->flash('type','success');
        session()->flash('title','Success');
        return redirect()->back();
    }

    public function topUpDeposit(Request $request)
    {
        $general = GeneralSetting::first();
        $basic = BasicSetting::first();
        $deposit = Deposit::findorfail($request->deposit_id);
        $user = User::findorfail($deposit->user_id);
        if($user->amount < $request->amount)
        {
            session()->flash('message','User Wallet Balance lower than Top Up amount, Please fund wallet and continue');
            session()->flash('type','warning');
            session()->flash('title','warning');
            return redirect()->back();
        }else{

            $userbal = new UserBalance();
            $userbal->user_id = $deposit->user_id;
            $userbal->balance_type = '10';
            $userbal->details = "Invest TOPUP ID: # ".$deposit['deposit_number'].'; '."Invest Plan : ".$deposit->plan->name;
            $userbal->balance = $request->amount;
            $userbal->new_balance = $user->amount - $request->amount;
            $userbal->old_balance = $user->amount;
            $userbal->save();

            $user->amount = $user->amount - $request->amount;
            $user->update();

            $tt = $deposit->amount + $request->amount;

            $mail_val2 = [
                'g_email' => $general->email,
                'g_title' => 'Investment TopUp Notification',
                'subject' => 'TopUp On Investment Notice.',
                'receiver' => $user->email,
            ];
            Config::set('mail.driver','mail');
            Config::set('mail.from',$general->email);
            Config::set('mail.name','Investment TopUp Notification');
            Mail::send('emails.top-up', ['orderfrom' =>$user->name,'old' => $deposit->amount,'amount' => $request->amount, 'total'=>$tt, 'investment' => $deposit->deposit_number, 'site_title'=>$general->title,'site_footer'=>$general->title], function ($m) use ($mail_val2) {
                $m->from($mail_val2['g_email'], $mail_val2['g_title']);
                $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
            });

            $deposit->amount = $deposit->amount + $request->amount;
            $deposit->update();
            session()->flash('message', 'Top Up Process Complete.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        }
    }
    public function completeDeposit(Request $request)
    {
        $deposit = Deposit::findorfail($request->id);
        $repeat = Repeat::wheredeposit_id($request->id)->first();
        $deposit->status = 1;
        $repeat->status = 1;
        $deposit->update();
        $repeat->update();
        session()->flash('message', 'Deposit Completion Process Complete.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function compoundUserAccount($id)
    {
        $new = new UserCompounding();
        $new->user_id = $id;
        $new->active = 1;
        $new->save();
        session()->flash('message', 'User Account Compounded Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function unCompoundUserAccount($id)
    {
        $new = UserCompounding::whereuser_id($id)->first();
        $new->delete();
        session()->flash('message', 'User Account unCompounded Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function checkCompounding(Request $request)
    {
        $new = UserCompounding::whereuser_id($request->id)->exist();

        return Response::json($new);
    }
    public function paymentWallets()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['wallets'] = PaymentWallet::all();
        $data['page_title'] = "All Payment Wallets";
        return view('dashboard.payment-wallets', $data);
    }
    public function createPaymentWallets(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'rate' => 'required',
            'image' => 'required',
            'fix' => 'required',
        ]);
        $wallet = $request->except('_method','_token');
        $wallet['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image'))
        {
            $wallet['image'] = $this->storeImage($request);
        }
        PaymentWallet::create($wallet);
        session()->flash('message', 'Wallet Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function edPaymentWallets($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['wallet'] = PaymentWallet::findorfail($id);
//        dd($data['wallet']);
        $data['page_title'] = "Edit Payment Wallet";
        return view('dashboard.edit-payment-wallet',$data);
    }
    public function updatePaymentWallets(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'rate' => 'required',
            'fix' => 'required',
        ]);
        $wallet = PaymentWallet::findorfail($request->id);
        $add = $request->except('_token','_method');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->save($location);
            $add['image'] = $filename;
        }
        $add['status'] = $request->status == 'on' ? '1' : '0';
        $wallet->fill($add)->save();
        session()->flash('message', 'Wallet Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('payment-wallets');

    }
    public function walletDetails(Request $request)
    {
        $basic = BasicSetting::first();
        $id = $request->id;
        $wid = PaymentWallet::findOrFail($id);
        $image = url('/assets/images').'/'.$wid->image;
        if($wid->status == 0)
            $st = '<span class="label label-secondary"><i class="fa fa-spinner"></i> Inactive</span>';
        elseif($wid->status == 1)
            $st = '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Active</span>';
        else
            $st = '<span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Inactive</span>';


        return '
                <div style="padding-bottom: 0;" class=" container well well-lg">
                    <div class="row">
                        <div class="com-sm-12">
                            <div class="">
                            <h5>Name : <strong>'.$wid->name.'</strong></h5>
                            <h5>Rate : <strong>'.$wid->rate.'</strong></h5>
                            <h5>Fix : <strong>'.$wid->fix.'</strong></h5>
                            <h5>Percent : <strong>'. $wid->percent.' </strong></h5>
                            <h5>Api : <strong>'. $wid->api.' </strong></h5>
                            <h5>Xpub : <strong>'. $wid->xpub.' </strong></h5>
                            <h5>Wallet 1 : <strong>'. $wid->wallet_1.' </strong></h5>
                            <h5>Wallet 2 : <strong>'. $wid->wallet_2.' </strong></h5>
                            <h5>Wallet 3 : <strong>'. $wid->wallet_3.' </strong></h5>
                            <h5>Status : <strong>'.$st.'</strong></h5>
                            <h5>Created At : <strong>'.Carbon::parse($wid->created_at)->diffForHumans().'</strong></h5>
                            <img src="'.$image.'" style="width: 100px; height: 100px;"/>
                            <hr>
                          
                            </div>
                        </div>
                    </div>
                </div>
                ';

    }
    public function tradeSetting()
    {
        $data['site_title'] = $this->site_title;
        $data['general'] = GeneralSetting::first();
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Manage Trade Setting";
        $data['category'] = TradeSetting::all();
        return view('dashboard.trade-setting', $data);
    }
    public function storeTradeSetting(Request $request)
    {
        $this->validate($request,[
            'time' => 'required',
            'unit' => 'required'
        ]);
        $category = TradeSetting::create($request->all());
        return Response::json($category);

    }
    public function editTradeSetting($task_id)
    {
        $category = TradeSetting::findOrFail($task_id);
        return Response::json($category);
    }
    public function updateTradeSetting(Request $request,$task_id)
    {
        $cat = TradeSetting::find($task_id);
        $this->validate($request,[
            'time' => 'required'.$cat->id,
            'unit' => 'required'
        ]);
        $cat->time = $request->time;
        $cat->unit = $request->unit;
        $cat->save();
        return Response::json($cat);

    }
    public function deleteUser(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $id = $request->id;
        $user = User::findorfail($id);
        $repeat = Repeat::whereuser_id($user->id)->get();
        $rebeat = RebeatLog::whereuser_id($user->id)->get();
        $fundlog = FundLog::whereuser_id($user->id)->get();
        $deposits = Deposit::whereuser_id($user->id)->get();
        $references = Reference::whereuser_id($user->id)->get();
        $balance = UserBalance::whereuser_id($user->id)->get();
        $wallet = UserWallet::whereuser_id($user->id)->get();
        $refer = UserReferral::whereuser_id($user->id)->get();
        $withdraw = Withdraw::whereuser_id($user->id)->get();
        $support = Support::whereuser_id($user->id)->get();
        $ad = AdminBalance::whereuser_id($user->id)->get();
        $li = LiveTrade::whereuser_id($user->id)->get();
        $letter = DB::table('letter_user')->whereuser_id($user->id)->get();
        $let = DB::table('latter_user')->whereuser_id($user->id)->get();
        foreach ($repeat as $r) {
            $r->delete();
        }
        foreach ($rebeat as $r) {
            $r->delete();
        }
        foreach ($fundlog as $r) {
            $r->delete();
        }
        foreach ($deposits as $r) {
            $r->delete();
        }
        foreach ($references as $r) {
            $r->delete();
        }
        foreach ($refer as $r) {
            $r->delete();
        }
        foreach ($balance as $r) {
            $r->delete();
        }
        foreach ($wallet as $r) {
            $r->delete();
        }
        foreach ($withdraw as $r) {
            $r->delete();
        }
        foreach ($support as $s)
        {
            $s->delete();
        }
        foreach ($ad as $s)
        {
            $s->delete();
        }
        foreach ($li as $s)
        {
            $s->delete();
        }
        foreach ($letter as $s)
        {
            $s->delete();
        }
        foreach ($let as $s)
        {
            $s->delete();
        }
        $user->delete();
        session()->flash('message', 'User Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return back();
    }

    public function updateUserWallet(Request $request)
    {
        $wallet = UserWallet::findorfail($request->id);
        $wallet->amount_in_usd = $request->usd;
        $wallet->amount_in_crypto = $request->crypto;
        $wallet->update();
        session()->flash('message', 'User Wallet Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return back();
    }
}
