<?php

namespace App\Http\Controllers;

use App\AdminBalance;
use App\BasicSetting;
use App\Deposit;
use App\GeneralSetting;
use App\ManualPayment;
use App\PaymentWallet;
use App\Plan;
use App\User;
use App\UserBalance;
use App\UserCompounding;
use App\UserWallet;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use DB;


class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newWithdraw()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Withdraw";
//        $data['method'] = ManualPayment::whereStatus(1)->get();
//        $data['method'] = PaymentWallet::whereStatus(1)->get();
        $data['method'] = UserWallet::whereuser_id(Auth::user()->id)->where('amount_in_usd', '>', 0)->wherestatus(1)->get();
        return view('withdraw.withdraw-new', $data);
    }

    public function checkAmount()
    {
        $amount = $_GET['amount'];
        $met = $_GET['method_id'];
//        $method = ManualPayment::findOrFail($met);
        $method = UserWallet::findorfail($met);
        $charge = $method->wallets->fix + (($amount * $method->wallets->percent) / 100);
        $hit = $charge + $amount;
        $user = $method->amount_in_usd;
//        $user = Auth::user()->amount;

        if ($hit > $user) {
            return response()->json([
                'status' => '300',
                'data' => 'Sorry Your Request Balance Larger Than Current balance.',
            ]);
        } else {
            return response()->json([
                'status' => '200',
                'data' => 'Well Done. Proceed with withdrawal.',
            ]);
        }
//        if($amount < $method->method_min){
//            return '<div class="col-md-12 " style="margin-bottom: -15px;">
//                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Withdraw Minimum Amount.</div>
//                </div>
//                <div class="col-md-12" style="text-align: right;margin-top: 10px;">
//                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
//
//                </div>';
//        }elseif ($amount > $method->method_max)
//        {
//            return '<div class="col-md-12" style="margin-bottom: -15px;">
//                    <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Withdraw Minimum Amount.</div>
//                </div>
//                <div class="col-md-12" style="text-align: right;margin-top: 10px;">
//                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
//
//                </div>';
//        }else{
//            return '<div class="col-md-12" style="margin-bottom: -15px;">
//                    <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. You can Withdraw This Amount.</div>
//                </div>
//                <div class="col-md-12" style="text-align: right;margin-top: 10px;">
//                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
//                    <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Withdraw Now</button>
//                </div>';
//        }

    }

    public function postWithdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'method_id' => 'required'
        ]);
//        $deposit = Deposit::whereuser_id(Auth::user()->id)->wherestatus(0)->get();
//        if($deposit->isEmpty())
        $c = UserCompounding::whereuser_id(Auth::user()->id)->whereactive(1)->first();
        if (!$c) {
            $data['general'] = GeneralSetting::first();
            $data['site_title'] = $data['general']->title;
            $data['basic'] = BasicSetting::first();
            $data['page_title'] = "Withdraw Preview";
//            $data['method'] = ManualPayment::findOrFail($request->method_id);
            $data['method'] = UserWallet::findorfail($request->method_id);;
            $data['amount'] = $request->amount;
            return view('withdraw.withdraw-preview', $data);
        } else {
            session()->flash('message', 'Withdrawal Inactive!!.. You have a compounding deposit running, Please contact support if you want to proceed.');
            Session::flash('type', 'danger');
            Session::flash('title', 'Important Information!');
            return redirect()->back();
        }

    }

    public function submitWithdraw(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required',
            'method_id' => 'required',
//            'acc_name' => 'required',
            'acc_number' => 'required',
//            'acc_code' => 'required'
        ]);
        $amount = $request->amount;
        $met = $request->method_id;
        $method = UserWallet::findOrFail($met);
        $charge = $method->wallets->fix + (($amount * $method->wallets->percent) / 100);
        $hit = $charge + $amount;
        $user = $method->amount_in_usd;
        $uuuu = User::findOrFail(Auth::user()->id);
        if ($hit > $user) {
            session()->flash('message', 'Your Request is Larger Than Current balance.');
            Session::flash('type', 'danger');
            Session::flash('title', 'danger');
            return redirect()->back();
        }
//        if($amount < $method->method_min){
//            session()->flash('message', 'Amount Is Smaller than Withdrawal Minimum Amount.');
//            Session::flash('type', 'warning');
//            Session::flash('title', 'Opps.!');
//            return redirect()->back();
//        }elseif ($amount > $method->method_max){
//            session()->flash('message', 'Amount Is Larger than Withdrawal Maximum Amount.');
//            Session::flash('type', 'warning');
//            Session::flash('title', 'Opps.!');
//            return redirect()->back();
//        }
        else {
            DB::beginTransaction();
            try {
                $basic = BasicSetting::first();
                $wid['user_id'] = Auth::user()->id;
                $wid['method_id'] = $met;
                $wid['amount'] = $amount;
                $wid['withdraw_number'] = date('ymd') . Str::random(6) . rand(11, 99);
                $wid['charge'] = $charge;
                $wid['total'] = $hit;
                $wid['new_balance'] = Auth::user()->amount - $hit;
                $wid['old_balance'] = Auth::user()->amount;
                $wid['message'] = $request->message;
                $wid['acc_name'] = $request->acc_name;
                $wid['acc_number'] = $request->acc_number;
                $wid['acc_code'] = $request->acc_code;
                $withdraw = Withdraw::create($wid);
                $us['user_id'] = Auth::user()->id;
                $us['balance_type'] = 4;
                $us['details'] = "Withdraw ID : # " . $withdraw->withdraw_number . " . " . " Withdraw By : " . $withdraw->wallets->wallets->name;
                $us['balance'] = $amount;
                $us['charge'] = $charge;
                $us['old_balance'] = Auth::user()->amount;
                $us['new_balance'] = Auth::user()->amount - ($amount + $charge);
                UserBalance::create($us);
                $ad['user_id'] = Auth::user()->id;
                $ad['balance_type'] = 4;
                $ad['details'] = "Withdraw ID : # " . $withdraw->withdraw_number . " . " . " Withdraw By : " . $withdraw->wallets->wallets->name;
                $ad['balance'] = $amount;
                $ad['charge'] = $charge;
                $ad['old_balance'] = $basic->admin_total;
                $ad['new_balance'] = $basic->admin_total + ($amount + $charge);
                $basic->admin_total = $ad['new_balance'];
                AdminBalance::create($ad);
                $basic->save();
                $uuuu->amount = $us['new_balance'];

                $wallet = UserWallet::findorfail($met);
                $wallet->amount_in_usd = $wallet->amount_in_usd - $amount;

//                $walname = Str::slug(strtolower($wallet->wallets->name));
//                $api = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids={$walname}");
//                $response = json_decode($api);
//                $rate = $response[0]->current_price;
                $rate = $wallet->wallets->crypto_rate;

                $calc = $wallet->amount_in_usd / $rate;
                $calc = round($calc, 6);

                $wallet->amount_in_crypto = $calc;
                $wallet->update();

                $uuuu->save();
                $general = GeneralSetting::first();
                $mail_val2 = [
                    'g_email' => $general->email,
                    'g_title' => 'Withdrawal Request Notification',
                    'subject' => 'Withdrawal Request Notice.',
                    'receiver' => 'admin@' . $general->title,
                ];
                Config::set('mail.driver', 'mail');
                Config::set('mail.from', $general->email);
                Config::set('mail.name', 'Withdrawal Request Notice');
                Mail::send('emails.withdraw-request', ['orderfrom' => $uuuu->name, 'amount' => $amount, 'acc' => $request->acc_number, 'trans_id' => $withdraw->withdraw_number, 'site_title' => $general->title, 'site_footer' => $general->title], function ($m) use ($mail_val2) {
                    $m->from($mail_val2['g_email'], $mail_val2['g_title']);
                    $m->to($mail_val2['receiver'])->subject($mail_val2['subject']);
                });
                DB::commit();

                session()->flash('message', 'Your Withdrawal Request Successfully Completed.');
                Session::flash('type', 'success');
                Session::flash('title', 'success');
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
    }

    public function withdrawHistory()
    {
        $data['general'] = GeneralSetting::first();
        $data['site_title'] = $data['general']->title;
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Withdrawal History";
        $data['withdraw'] = Withdraw::whereUser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('withdraw.withdraw-history', $data);
    }


}
