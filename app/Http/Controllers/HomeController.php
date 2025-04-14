<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\Announcement;
use App\BasicSetting;
use App\Category;
use App\Chose;
use App\Deposit;
use App\Fund;
use App\FundLog;
use App\GeneralSetting;
use App\Menu;
use App\News;
use App\Page;
use App\Partner;
use App\Payment;
use App\PaymentWallet;
use App\Plan;
use App\Promo;
use App\Reference;
use App\Slider;
use App\Strategy;
use App\Testimonial;
use App\User;
use App\UserBalance;
use App\UserCompounding;
use App\UserReferral;
use App\UserWallet;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\RebeatLog;
use App\Repeat;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Home Page";
        $data['plan'] = Plan::whereStatus(1)->orderBy('id', 'ASC')->take(3)->get();
        $data['planc'] = Plan::whereStatus(1)->orderBy('id', 'ASC')->get();
        $data['strategy'] = Strategy::take(6)->get();
        $data['page'] = Page::first();
        $data['menu'] = Menu::all();
        $data['slider'] = Slider::all();
        $data['promo'] = Promo::all();
        $data['testimonial'] = Testimonial::all();
        $data['chose'] = Chose::all();
        $data['news'] = News::orderBy('id','DESC')->take(3)->get();
        $data['news_rand'] = News::inRandomOrder()->take(4)->get();
        $data['partner'] = Partner::all();
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        $data['lplan'] = Plan::whereStatus(1)->first();
//        $a_news = file_get_contents("http://newsapi.org/v2/everything?q=bitcoin&pageSize=3&sortBy=publishedAt&apiKey=b83be1177d8f41af841491926401c1b6");
//        $reponse = json_decode($a_news);
//        $data['anews'] = $reponse->articles;
        return view('home.new-home',$data);
    }
    public function getAbout()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['page_title'] = "About US";
        $data['page'] = Page::first();
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        $data['tt'] = 'about';
        return view('home.about',$data);
    }
    public function getFaq()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Faqs Page";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'faq';
        return view('home.faq',$data);
    }
    public function getHowItWorks()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "How It Works Page";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'How It Works';
        return view('home.howitworks',$data);
    }
    public function shop()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Market";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Market';
        return view('home.market',$data);
    }
    public function getDocument()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['payment'] = Payment::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Document Page";
        $data['page'] = Page::first();
        $data['tt'] = 'document';
        return view('home.about',$data);
    }
    public function getTerms()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Terms & Condition";
        $data['payment'] = Payment::first();
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['tt'] = 'terms';
        return view('home.terms',$data);
    }
    public function getBandbook()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "BrandBook";
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['tt'] = 'bankbook';
        return view('home.about',$data);
    }
    public function getPrivacy()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Privacy";
        $data['payment'] = Payment::first();
        $data['page'] = Page::first();
        $data['tt'] = 'privacy';
        return view('home.privacy',$data);
    }
    public function getContact()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Contact";
        $data['payment'] = Payment::first();
        return view('home.contact',$data);
    }
    public function getServices()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['page_title'] = "Services";
        $data['payment'] = Payment::first();
        return view('home.services',$data);
    }
    public function submitContact(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $general = GeneralSetting::first();
        $mail_val = [
            'email' => $request->email,
            'name' => $request->name,
            'g_email' => $general->email,
            'g_title' => $general->title,
            'subject' => $request->subject,
            'sub' => 'Contact Message'
        ];
        Mail::send('emails.contact', ['subject' => $request->subject,'name' => $request->name,'phone' => $request->phone,'description'=>$request->message], function ($m) use ($mail_val) {
            $m->from($mail_val['email'], $mail_val['name']);
            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['sub']);
        });

        session()->flash('message', 'Message Successfully Sent.');
        return redirect()->back();
    }
    public function investment()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Choose Plan";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['plan'] = Plan::whereplan_type_id(1)->wherestatus(1)->get();
        $data['lplan'] = Plan::whereplan_type_id(1)->wherestatus(1)->first();
        $data['payment'] = Payment::first();
        $data['tt'] = 'affiliate';
        return view('home.investment',$data);
    }
    public function bots()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Maxon Bots";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['plan'] = Plan::whereplan_type_id(1)->wherestatus(1)->get();
        $data['lplan'] = Plan::whereplan_type_id(1)->wherestatus(1)->first();
        $data['payment'] = Payment::first();
        $data['tt'] = 'affiliate';
        return view('home.bots',$data);
    }
    public function getOTP()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "OTP";
        return view('auth.otp',$data);
    }
    public function affiliate()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Affiliate";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Affiliate';
        return view('home.affiliate',$data);
    }
    public function compounding()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Compounding";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Compounding';
        return view('home.compounding',$data);
    }
    public function security()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Security";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Security';
        return view('home.security',$data);
    }
    public function careers()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Careers";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Careers';
        return view('home.careers',$data);
    }
    public function referral()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Referrals";
        $data['menu'] = Menu::all();
        $data['page'] = Page::first();
        $data['category'] = Category::all();
        $data['payment'] = Payment::first();
        $data['tt'] = 'Referrals';
        return view('home.referral',$data);
    }
    public function getNews()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "News Page";
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['payment']  = Payment::first();
//        $data['news'] = News::orderBy('id','DESC')->paginate(5);
        $a_news = file_get_contents("http://newsapi.org/v2/everything?q=bitcoin&pageSize=15&sortBy=publishedAt&apiKey=1dc82a9166dc4cdab2d497ef1b8fc774");
        $reponse = json_decode($a_news);
        $data['news'] = $reponse->articles;
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        return view('home.news',$data);
    }
    public function newsDetails($id,$slug)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['news'] = News::findOrFail($id);
        $v = News::findOrFail($id);
        $v->view = $v->view + 1;
        $v->save();
        $data['payment']  = Payment::first();
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        $data['page_title'] = $data['news']->title;
        return view('home.news-details',$data);
    }
    public function submitNewsLetter(Request $request)
    {
        session()->flash('message.level', 'success');
        session()->flash('message.content', 'Thank you for subscribing.');
        return back()->with('#session');
    }
    public function categoryNews($id,$slug)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['menu'] = Menu::all();
        $data['category'] = Category::all();
        $data['news_rand'] = News::inRandomOrder()->take(15)->get();
        $data['payment'] = Payment::first();
        $data['news'] = News::whereCategory_id($id)->orderBy('id','DESC')->paginate(10);
        $data['page_title'] = 'Category Wise News';
        return view('home.news',$data);
    }
    public function menu($id)
    {
        $data['page_title'] =  'Menu';
        $data['general'] = GeneralSetting::first();
        $gen = GeneralSetting::first();
        $data['payment'] = Payment::first();
        $data['site_title'] = $gen->title;
        $data['category'] = Category::all();
        $data['menu'] = Menu::all();
        $data['menu1'] = Menu::findOrFail($id);
        return view('home.menu',$data);
    }
    public function perfectIPN()
    {
        $pay = Payment::first();
        $passphrase=strtoupper(md5($pay->perfect_alternate));

        define('ALTERNATE_PHRASE_HASH',  $passphrase);
        define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
        $string=
            $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
            $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
            $_POST['PAYMENT_BATCH_NUM'].':'.
            $_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
            $_POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if($hash==$hash2){

            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $depoistTrack = $_POST['PAYMENT_ID'];
            $funlog = FundLog::whereTransaction_id($depoistTrack)->first();

            $ammch = $funlog->fix + (($funlog->amount * $funlog->percent) / 100);

            $amm = round((($funlog->amount + $ammch) / $funlog->rate),2) ;

            $main_am = $amm;

            if($_POST['PAYEE_ACCOUNT']=="$pay->perfect_acount" && $unit=="USD" && $amo ==$main_am){

                $user = User::findOrFail($funlog->user_id);
                $basic = BasicSetting::first();

                // Fun Log
                $fu['user_id'] = $user->id;
                $fu['payment_type'] = 2;
                $fu['transaction_id'] = $funlog->transaction_id;
                $fu['amount'] = $funlog->amount;
                $fu['rate'] = $funlog->rate;
                $fu['charge'] = $ammch;
                $fu['total'] = $main_am;
                Fund::create($fu);

                // user Log
                $us['user_id'] = $user->id;
                $us['balance_type'] = 1;
                $us['details'] = "Fund Add via Perfect Money. Transaction id : # ".$funlog->transaction_id;
                $us['balance'] = $funlog->amount;
                $us['charge'] = $ammch;
                $us['old_balance'] = $user->amount;
                $us['new_balance'] = $user->amount + ($funlog->amount);
                UserBalance::create($us);
                $user->amount = $us['new_balance'];
                $user->save();

                // Admin log
                $ad['user_id'] = $user->id;
                $ad['balance_type'] = 1;
                $ad['details'] = "Fund Deposit via Perfect Money. Transaction id : # ".$funlog->transaction_id;
                $ad['balance'] = $funlog->amount;
                $ad['charge'] = $ammch;
                $ad['old_balance'] = $basic->admin_total;
                $ad['new_balance'] = $ammch + $basic->admin_total + $funlog->amount;
                AdminBalance::create($ad);
                $basic->admin_total = round($ad['new_balance'],3);
                $basic->save();
                
                session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');
                
            }
        }
    }

    public function paypalIpn()
    {
        $payment_type		=	$_POST['payment_type'];
        $payment_date		=	$_POST['payment_date'];
        $payment_status		=	$_POST['payment_status'];
        $address_status		=	$_POST['address_status'];
        $payer_status		=	$_POST['payer_status'];
        $first_name			=	$_POST['first_name'];
        $last_name			=	$_POST['last_name'];
        $payer_email		=	$_POST['payer_email'];
        $payer_id			=	$_POST['payer_id'];
        $address_country	=	$_POST['address_country'];
        $address_country_code	=	$_POST['address_country_code'];
        $address_zip		=	$_POST['address_zip'];
        $address_state		=	$_POST['address_state'];
        $address_city		=	$_POST['address_city'];
        $address_street		=	$_POST['address_street'];
        $business			=	$_POST['business'];
        $receiver_email		=	$_POST['receiver_email'];
        $receiver_id		=	$_POST['receiver_id'];
        $residence_country	=	$_POST['residence_country'];
        $item_name			=	$_POST['item_name'];
        $item_number		=	$_POST['item_number'];
        $quantity			=	$_POST['quantity'];
        $shipping			=	$_POST['shipping'];
        $tax				=	$_POST['tax'];
        $mc_currency		=	$_POST['mc_currency'];
        $mc_fee				=	$_POST['mc_fee'];
        $mc_gross			=	$_POST['mc_gross'];
        $mc_gross_1			=	$_POST['mc_gross_1'];
        $txn_id				=	$_POST['txn_id'];
        $notify_version		=	$_POST['notify_version'];
        $custom				=	$_POST['custom'];

        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $payment = Payment::first();
        $paypal_email = $payment->paypal_email;

        if($payer_status=="verified" && $payment_status=="Completed" && $receiver_email==$paypal_email && $ip=="notify.paypal.com"){

            $data = FundLog::where('transaction_id' , $custom)->first();

            $charge = $payment->paypal_fix + ($data->amount * $payment->paypal_percent / 100);
            $totalamo = round(($data->amount + $charge) / $payment->paypal_rate,3);

            if($totalamo == $mc_gross)
            {
                $uuuu = User::findOrFail($data->user_id);
                $data->status = 1;

                // Fun Create

                $fun['user_id'] = $data->user_id;
                $fun['payment_type'] = 1;
                $fun['transaction_id'] = $data->transaction_id;
                $fun['amount'] = $data->amount;
                $fun['rate'] = $data->rate;
                $fun['charge'] = $charge;
                $fun['total'] = $mc_gross;
                Fund::create($fun);

                // User Log Create

                $us['user_id'] = $data->user_id;
                $us['payment_type'] = 1;
                $us['derails'] = "Fund Add via Paypal. Transaction id : # ".$data->transaction_id;
                $us['balance'] = $data->amount;
                $us['charge'] = $charge;
                $us['old_balance'] = $uuuu->amount;
                $us['new_balance'] = $data->amount + $us['old_balance'];
                $uuuu->amount = $us['new_balance'];
                $uuuu->save();
                UserBalance::create($us);

                // Admin Log

                $bas = BasicSetting::first();
                $ad['user_id'] = $data->user_id;
                $ad['payment_type'] = 1; //paypal
                $ad['transaction_id'] = $data->transaction_id;
                $ad['balance'] = $data->amount;
                $ad['details'] = "Fund Deposit via Paypal. Transaction ID : # ".$data->transaction_id;
                $ad['charge'] = $charge;
                $ad['old_balance'] = $bas->admin_total;
                $ad['new_balance'] = $bas->admin_total + $data->amount + $charge;
                AdminBalance::create($ad);
                $bas->admin_total = $ad['new_balance'];
                $bas->save();
                $data->save();
                
                session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');  
            }
        }
    }

    public function btcIPN()
    {
        $depoistTrack = $_GET['invoice_id'];
        $secret = $_GET['secret'];
        $address = $_GET['address'];
        $value = $_GET['value'];
        $confirmations = $_GET['confirmations'];
        $value_in_btc = $_GET['value'] / 100000000;

        $trx_hash = $_GET['transaction_hash'];

        $DepositData = FundLog::whereTransaction_id($depoistTrack)->first();

        if ($DepositData->status == 0){

        if ($DepositData->btc_amo == $value_in_btc && $DepositData->btc_acc == $address && $secret=="ABIR" && $confirmations>2){

            $charge = $DepositData->fix + ($DepositData->amount * $DepositData->percent) / 100;
            $uuuu = User::findOrFail($DepositData->user_id);

            // Fun Create

            $fun['user_id'] = $DepositData->user_id;
            $fun['payment_type'] = 1;
            $fun['transaction_id'] = $DepositData->transaction_id;
            $fun['amount'] = $DepositData->amount;
            $fun['rate'] = $DepositData->rate;
            $fun['charge'] = $charge;
            $fun['total'] = $DepositData->btc_amo;
            Fund::create($fun);

            // User Log Create

            $us['user_id'] = $DepositData->user_id;
            $us['payment_type'] = 1;
            $us['derails'] = "Fund Add via BlockChain. Transaction id : # ".$DepositData->transaction_id;
            $us['balance'] = $DepositData->amount;
            $us['charge'] = $charge;
            $us['old_balance'] = $uuuu->amount;
            $us['new_balance'] = $DepositData->amount + $us['old_balance'];
            $uuuu->amount = $us['new_balance'];
            $uuuu->save();
            UserBalance::create($us);

            // Admin Log

            $bas = BasicSetting::first();
            $ad['user_id'] = $DepositData->user_id;
            $ad['payment_type'] = 3; //Blockchain
            $ad['transaction_id'] = $DepositData->transaction_id;
            $ad['balance'] = $DepositData->amount;
            $ad['details'] = "Fund Deposit via BlockChain. Transaction ID : # ".$DepositData->transaction_id;
            $ad['charge'] = $charge;
            $ad['old_balance'] = $bas->admin_total;
            $ad['new_balance'] = $bas->admin_total + $DepositData->amount + $charge;
            AdminBalance::create($ad);
            $bas->admin_total = $ad['new_balance'];
            $bas->save();
            
            session()->flash('message','Fund Successfully Deposit.');
                session()->flash('type','success');
                session()->flash('title','Success');
                return redirect()->route('add-fund');
        }
        }
    }

    public function withdrawDetails(Request $request)
    {
        $basic = BasicSetting::first();
        $id = $request->id;
        $wid = Withdraw::findOrFail($id);
        if($wid->status == 0)
            $st = '<span class="label label-secondary"><i class="fa fa-spinner"></i> Pending</span>';
        elseif($wid->status == 1)
            $st = '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>';
        else
            $st = '<span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Refunded</span>';

        if($wid->made_date == null)
            $md = '<span class="label label-danger"><i class="fa fa-times"></i> Not Seen Yet.</span>';
        else
            $md = Carbon::parse($wid->made_date)->format('d F Y h:i:s A');

        return '<div class="modal-body">

                    <div class="row">
                        <div class="com-sm-12">
                            <div class="" style="word-break: break-word;">
                            <h5>Submitted Date : <strong>'.Carbon::parse($wid->created_at)->format('d F Y h:i:s A').'</strong></h5>
                            <h5>Created At : <strong>'.Carbon::parse($wid->created_at)->diffForHumans().'</strong></h5>
                            <h5>Method : <strong>'.$wid->wallets->wallets->name.'</strong></h5>
                            <h5>Wallet Address : <strong>'.$wid->acc_number.'</strong></h5>
                            <h5>Amount : <strong>'.$basic->currency.' '. $wid->amount.' </strong></h5>
                            <h5>Charge : <strong>'.$basic->currency.' '. $wid->charge.'</strong></h5>
                            <h5>Total Deducted : <strong>'.$basic->currency.' '. $wid->total.'</strong></h5>
                            <h5>Present Balance : <strong>'.$basic->currency.' '. $wid->new_balance.'</strong></h5>
                            <h5>Past Balance : <strong>'.$basic->currency.' '. $wid->old_balance.'</strong></h5>
                            <h5>Status : <strong>'.$st.'</strong></h5>
                            <h5>Made Date : <strong>'.$md.'</strong></h5>
                            <hr>
                            <h5><strong>Message : </strong> '.$wid->message.'</h5>
                            </div>
                        </div>
                    </div>
                </div>';

    }

    public function swapDetails(Request $request)
    {
        $wallet = $request->wallet;
        $amount = $request->amount;
        $userwallet = UserWallet::findorfail($wallet);
        if($amount == null)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Please Enter Amount to swap in USD.</div>
            </div>
            ';
        }
        if ($request->amount > $userwallet->amount_in_usd)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount to swap is greater than balance.</div>
            </div>
            ';
        }
        if ($request->amount <= 0)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount to swap is lower than balance.</div>
            </div>
            ';
        }
        else{
            return '<div class="col-md-12 col-sm-offset-4" id="mmsg">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You Can Swap this Amount. Please Select a coin to swap to</div>
            </div>
            ';
        }

    }
    public function referralTransferCheck(Request $request)
    {
        $amount = $request->amount;
        $bonus = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $ref = UserReferral::whereUser_id(Auth::user()->id)->sum('balance');
        $balance = $bonus - $ref;
        if($amount == null)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Please Enter Amount to Transfer in USD.</div>
            </div>
            ';
        }
        if ($request->amount > $balance)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount to Transfer is greater than Referral Bonus.</div>
            </div>
            ';
        }
        if ($request->amount <= 0)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount to Transfer is less than Referral Bonus.</div>
            </div>
            ';
        }
        else{
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You Can Transfer this Amount. Please Select a wallet to Transfer to</div>
            </div>
           <div class="col-md-12 col-sm-offset-4">
            <button type="submit" class="btn btn-info bt2"><i class="fa fa-send"></i> Transfer</button></div>
            ';
        }

    }

    public function swapCheck(Request $request)
    {
        $wallet = PaymentWallet::findorfail($request->wallet2);
        $amount = $request->amount;
//        $walname = strtolower(Str::slug($wallet->name));
//        $api = @file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//        $response = json_decode($api);
//        $rate = $response[0]->current_price;
        $rate = $wallet->crypto_rate;
        $calc = $amount / $rate;
        $calc = round($calc, 6);
        return $calc;
    }

    public function viewAnnouncement(Request $request)
    {
        $basic = BasicSetting::first();
        $id = $request->id;
        $wid = Announcement::findOrFail($id);
        return '<div class="modal-body">

                    <div class="row">
                        <div class="com-sm-12">
                            <div class="text-center">
                           
                            <h3><strong>'.$wid->title.'</strong></h3>
                           
                            <hr>
                            <h4>'.$wid->description.'</h4>
                            </div>
                        </div>
                    </div>
                </div>';
    }

//    public function rebetgen()
//    {
//        $now = Carbon::parse()->toDateTimeString();
//        $rep = Repeat::whereStatus(0)->get();
//        $basic = BasicSetting::first();
//        foreach ($rep as $r){
//            if ($r->repeat_time < $now){
//                $user = User::findOrFail($r->user_id);
//                $ra = Repeat::findOrFail($r->id);
//                if ($ra->rebeat != $r->deposit->time){
//                    $us['user_id'] = $user->id;
//                    $us['balance_type'] = 3;
//                    $us['balance'] = ($r->deposit->amount * $r->deposit->percent) / 100;
//                    $us['old_balance'] = $user->amount;
//                    $us['new_balance'] = $user->amount + $us['balance'];
//                    $us['details'] = "Invest ID: # ".$r->deposit->deposit_number.' '."Invest Plan : ".$r->deposit->plan->name;
//                    $user->amount = $us['new_balance'];
//                    UserBalance::create($us);
//                    $user->save();
//                    $log['user_id'] = $user->id;
//                    $log['deposit_id'] = $r->deposit->id;
//                    $log['balance'] = $us['balance'];
//                    $log['made_time'] = Carbon::now();
//                    RebeatLog::create($log);
//                    $ra->made_time = Carbon::now();
//                    $ra->repeat_time = Carbon::parse()->addHours($r->deposit->compound->compound);
//                    $ra->rebeat = $ra->rebeat + 1;
//                    $ra->save();
//
//                    $ad1['user_id'] = $user->id;
//                    $ad1['balance_type'] = 3;
//                    $ad1['balance'] = $us['balance'];
//                    $ad1['old_balance'] = $basic->admin_total;
//                    $ad1['new_balance'] = $basic->admin_total - $us['balance'];
//                    $ad1['details'] = "Invest ID: # ".$r->deposit->deposit_number.'; '."Invest Plan : ".$r->deposit->plan->name;
//                    AdminBalance::create($ad1);
//                    $basic->admin_total = $ad1['new_balance'];
//                    $basic->save();
//
//                    if($ra->rebeat == $r->deposit->time){
//                        $ra->status = 1;
//                        $ra2 = Deposit::findorfail($ra->deposit_id);
//                        $user->amount = $user->amount + $ra2->amount;
//                        $user->save();
//                        $ra2->status = 1;
//                        $ra2->save();
//                        $ra->save();
//                    }
//
//                }else{
//                    $ra->status = 1;
//                    $ra2 = Deposit::findorfail($ra->deposit_id);
//                    $user->amount = $user->amount + $ra2->amount;
//                    $user->save();
//                    $ra2->status = 1;
//                    $ra2->save();
//                    $ra->save();
//                }
//
//            }
//        }
//    }

    public function rebetgen()
    {
        $now = Carbon::parse()->toDateTimeString();
        $rep = Repeat::whereStatus(0)->get();
        $basic = BasicSetting::first();
        foreach ($rep as $r){
            if ($r->repeat_time < $now){
                $user = User::findOrFail($r->user_id);
                $ra = Repeat::findOrFail($r->id);
                $comp = UserCompounding::whereuser_id($r->user_id)->exists();
                if ($ra->rebeat != $r->deposit->time)
                {
                    DB::beginTransaction();
                    try
                    {
                        $us['user_id'] = $user->id;
                        $us['balance_type'] = 3;
                        $us['balance'] = ($r->deposit->amount * $r->deposit->percent) / 100;
                        $us['old_balance'] = $user->amount;
                        $us['new_balance'] = $user->amount + $us['balance'];
                        $us['details'] = "Invest ID: # " . $r->deposit->deposit_number . ' ' . "Invest Plan : " . $r->deposit->plan->name;
                        $user->amount = $us['new_balance'];
                        UserBalance::create($us);
                        if($comp)
                        {
                            $dep = Deposit::findorfail($ra->deposit_id);
                            $dep->amount = $dep->amount + $us['balance'];
                            $dep->update();
                        }else{
                            $user->save();

                            $wallet = UserWallet::findorfail($ra->wallet_id);
                            $wallet->amount_in_usd = $wallet->amount_in_usd + $us['balance'];

//                            $api = file_get_contents("https://api.nomics.com/v1/currencies/ticker?key=0a23c011154f1655b1d4b81fb5675608&ids={$wallet->wallets->short}&interval=1d,30d&convert=USD&per-page=100&page=1");
//                            $walname = strtolower(Str::slug($wallet->wallets->name));
//                            $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                            $response = json_decode($api);
//                            $rate = $response[0]->current_price;
//                            dd($rate);

//                            $calc = $wallet->amount_in_usd / $rate;
                            $calc = $wallet->amount_in_usd / $wallet->wallets->crypto_rate;
                            $calc = round($calc, 6);

                            $wallet->amount_in_crypto = $calc;
                            $wallet->update();
                        }
                        $log['user_id'] = $user->id;
                        $log['deposit_id'] = $r->deposit->id;
                        $log['balance'] = $us['balance'];
                        $log['wallet_id'] = $ra->wallet_id;
                        $log['made_time'] = Carbon::now();
                        RebeatLog::create($log);

                        $ra->made_time = Carbon::now();
                        $ra->repeat_time = Carbon::parse()->addHours($r->deposit->compound->compound);
                        $ra->rebeat = $ra->rebeat + 1;
                        $ra->save();

                        $ad1['user_id'] = $user->id;
                        $ad1['balance_type'] = 3;
                        $ad1['balance'] = $us['balance'];
                        $ad1['old_balance'] = $basic->admin_total;
                        $ad1['new_balance'] = $basic->admin_total - $us['balance'];
                        $ad1['details'] = "Invest ID: # " . $r->deposit->deposit_number . '; ' . "Invest Plan : " . $r->deposit->plan->name;
                        AdminBalance::create($ad1);
                        $basic->admin_total = $ad1['new_balance'];
                        $basic->save();

                        if ($ra->rebeat == $r->deposit->time) {
                            $ra->status = 1;
                            $ra2 = Deposit::findorfail($ra->deposit_id);
                            $user->amount = $user->amount + $ra2->amount;
                            $user->save();
                            $ra2->status = 1;
                            $ra2->save();
                            $ra->save();
                        }

                        DB::commit();
                    }catch (\Exception $exception)
                    {
                        return $exception;
                    }

                }else{
                    $ra->status = 1;
                    $ra2 = Deposit::findorfail($ra->deposit_id);
                    $user->amount = $user->amount + $ra2->amount;
                    $user->save();
                    $ra2->status = 1;
                    $ra2->save();
                    $ra->save();
                }

            }
        }
    }
    
    public function deleteDets()
    {
        $repeat = RebeatLog::all();
        
        $r = $repeat::groupBy('deposit_id')->get();
        dd($repeat);
    }
    public function doCompounding()
    {
        $compounding = UserCompounding::all();
        foreach ($compounding as $c)
        {
            $user = $c->user_id;
            $deposits = Deposit::whereuser_id($user)->get();
        }
    }
    public function cryptoPrices($id)
    {
        $wallet = PaymentWallet::whereshort($id)->first();
        $walname = strtolower($wallet->name);
        $api = @file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
        $response = json_decode($api);
        $rate = $response[0]->current_price;
        $rate = round($rate, 2);
        return $rate;
    }
    public function assignBotPairs()
    {
        $plan = Plan::whereplan_type_id(2)->wherestatus(1)->get();
        $planc = Plan::whereplan_type_id(2)->wherestatus(1)->count();
        $arrayp = ['EUR','USD','GBP'];
        $k = array_rand($arrayp);
        $v = $arrayp[$k];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://twelve-data1.p.rapidapi.com/forex_pairs?currency_base=$v&format=json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: twelve-data1.p.rapidapi.com",
                "X-RapidAPI-Key: 799c39329fmsh368ea968648e42dp10d1b1jsna79098000e92"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);
            $datap = $response->data;
            foreach($datap as $d)
            {
                $array_p[] = $d->symbol;
            }
            $x = 0;
            foreach($plan as $pl)
            {
               $x++;
               $pl->trading_pair = $array_p[$x];
                $pl->update();
            }

        }
    }
    public function setRate()
    {
        $wallets = PaymentWallet::all();
        foreach ($wallets as $wallet)
        {
            $cr = PaymentWallet::findorfail($wallet->id);
            $walname = strtolower($wallet->name);
            $walname = Str::slug($walname);
            $api = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids={$walname}&vs_currencies=usd");
            $response = json_decode($api);
            // dd($response);
            $rate = $response->$walname->usd;
            $cr->crypto_rate = $rate;
            $cr->update();
        }
    }

}
