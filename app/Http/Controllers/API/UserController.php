<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Handler;
use App\BasicSetting;
use App\Compound;
use App\Deposit;
use App\DepositImage;
use App\Http\Controllers\Controller;
use App\Investment;
use App\PaymentLog;
use App\PaymentMethod;
use App\Plan;
use App\Repeat;
use App\RepeatLog;
use App\Support;
use App\SupportMessage;
use App\TraitsFolder\MailTrait;
use App\User;
use App\UserLog;
use App\WithdrawLog;
use App\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function getDashboard()
    {
        $data['page_title'] = 'User Dashboard';

        $data['reference_title'] = "Reference User";
        $data['basic_setting'] = BasicSetting::first();
        $data['reference_user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();
        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['balance'] = $data['user'];
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->whereStatus(1)->sum('amount');
        $data['repeat'] = RepeatLog::whereUser_id(Auth::user()->id)->sum('amount');
        $data['withdraw'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereIn('status',[2])->sum('amount');
        $data['refer'] = User::where('under_reference',Auth::user()->id)->count();

        /*//$data['image']= User->image;
        $data['usvalue']= $this->apiauth()->getSpotPrice('BTC-USD')->getAmount();
        $data['buyvalue']=$this->apiauth()->getBuyPrice('BTC-USD')->getAmount();
        $data['sellvalue']=$this->apiauth()->getSellPrice('BTC-USD')->getAmount();*/
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try
        {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                return response()->json ([
                    'status' => $this->successStatus,
                    'message' => 'Password Changes Successfully',
                ]);
            }else{
                return response()->json ([
                    'status' => $this->errorStatus,
                    'message' => 'Current Password Not Match',
                ]);
            }

        } catch (\PDOException $e) {
            return response()->json ([
                'status' => $this->errorStatus,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function profile()
    {
        $data['page_title'] = "Edit Profile";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|min:10|unique:users,phone,'.$user->id,
            'username' => 'required|min:5|unique:users,username,'.$user->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        $in['reference'] = $request->username;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = $request->username.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            $in['image'] = $filename;
            if ($user->image != 'user-default.png'){
                $path = './assets/images/';
                $link = $path.$user->image;
                if (file_exists($link))
                {
                    unlink($link);
                }
            }
            Image::make($image)->resize(400,400)->save($location);
        }
        $user->fill($in)->save();
        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Profile Updated Successfully',
        ]);
    }
    public function depositMethod()
    {
        $data['page_title'] = 'Deposit Method';
        $data['gateways'] = PaymentMethod::whereStatus(1)->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function submitDepositFund(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'amount'         => 'required',
            'payment_type'   => 'required',
        ]);

        $pay_id = $request->payment_type;
        $amount = $request->amount;

        if($pay_id < 800)
        {
            $gate = PaymentMethod::findOrFail($request->payment_type);

            if($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount)
            {
                $charge = $gate->fix + ($request->amount*$gate->percent/100);
                $usdamo = ($request->amount + $charge)/$gate->rate;

                $lo['member_id'] = Auth::id();
                $lo['payment_type'] = $gate->id;
                $lo['custom'] = strtoupper(Str::random(20));
                $lo['amount'] = $amount;
                $lo['charge'] = round($charge,$basic->deci);
                $lo['net_amount'] = $usdamo;
                $lo['usd'] = $usdamo;
                $lo['btc_amo'] = 0;
                $lo['btc_acc'] = '';
                $lo['status'] = 0;
                $lo['try'] = 0;
                $payment_log = PaymentLog::create($lo);


                Session::put('Track', $lo['custom']);

                return redirect()->route('deposit-preview');

            }
            else
            {
                session()->flash('message', 'Please Follow Deposit Limit');
                session()->flash('title','Success');
                Session::flash('type', 'success');
                return back();

            }
        }
        else
        {
            $gateway = PaymentMethod::whereId($pay_id)->first();
            $charge = $gateway->fix + ( $amount*$gateway->percent / 100 );
            $lo['usd'] = round(($amount + $charge) / $gateway->rate,2);
        }

        $lo['member_id'] = Auth::user()->id;
        $lo['custom'] = strtoupper(Str::random(20));
        $lo['amount'] = $amount;
        $lo['charge'] = round($charge,$basic->deci);
        $lo['net_amount'] = $amount + $charge;
        $lo['payment_type'] = $request->payment_type;

        $payment_log = PaymentLog::create($lo);

        $data['fund'] = $payment_log;
        $payment_log_id =  $payment_log->id;
        session(['payment_log_id' => $payment_log_id]);

        if($payment_log->payment_type>800)
        {
            $trans = $payment_log;
            $page_title = 'Manual Deposit Document Submit';

            return view('user.manuldepositsubmit',compact('trans','page_title'));

        }
    }

    public function depositPreview()
    {
        $track = Session::get('Track');
        $data['fund'] = PaymentLog::where('status',0)->where('custom',$track)->first();
        $data['page_title'] = 'Deposit Preview';
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }

    public function manualDepositSubmit(Request $request)
    {
        $this->validate($request,[
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'fund_id' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $fund = PaymentLog::findOrFail($request->fund_id);

            $de['user_id'] = Auth::user()->id;
            $de['amount'] = $fund->amount;
            $de['charge'] = $fund->charge;
            $de['net_amount'] = $fund->net_amount;
            $de['payment_type'] = $fund->payment_type;
            $de['message'] = $request->message;
            $de['transaction_id'] = $fund->custom;
            $dep = Deposit::create($de);

            if($request->hasFile('image')){
                $image3 = $request->file('image');
                foreach ($image3 as $img){
                    $filename3 = time().'h3'.'.'.$img->getClientOriginalExtension();
                    $location = 'assets/deposit/' . $filename3;
                    Image::make($img)->save($location);
                    $in['image'] = $filename3;
                    $in['deposit_id'] = $dep->id;
                    DepositImage::create($in);
                }
            }
            DB::commit();
            return response()->json ([
                'status' => $this->successStatus,
                'message' => 'Deposit Successfully Submitted. Wait For Confirmation',
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

    }
    public function historyDepositFund()
    {
        $data['page_title'] = "Deposit History";
        $data['deposit'] = Deposit::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function userActivity()
    {
        $data['page_title'] = "Transaction Log";
        $data['log'] = UserLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function withdrawRequest()
    {

        $data['page_title'] = "Withdraw Method";
        $data['basic'] = BasicSetting::first();
        if ($data['basic']->withdraw_status == 0){
            return response()->json ([
                'status' => $this->errorStatus,
                'message' => 'Withdrawal is Currently Unavailable, Please try Again Later.',
            ]);
        }
        $data['method'] = WithdrawMethod::whereStatus(1)->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function submitWithdrawRequest(Request $request)
    {
        $this->validate($request,[
            'method_id' => 'required',
            'amount' => 'required'
        ]);
        $basic = BasicSetting::first();
        $bal = User::findOrFail(Auth::user()->id);
        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100,$basic->deci);
        $reAmo = $request->amount + $ch;
        if ($reAmo < $method->withdraw_min)
        {
            return response()->json ([
                'status' => $this->errorStatus,
                'message' => 'Your Request Amount is Smaller Than Withdraw Minimum Amount.',
            ]);
        }
        if ($reAmo > $method->withdraw_max)
        {
            return response()->json ([
                'status' => $this->errorStatus,
                'message' => 'Your Request Amount is Larger Than Withdraw Maximum Amount.',
            ]);
        }
        if ($reAmo > $bal->balance)
        {
            return response()->json ([
                'status' => $this->errorStatus,
                'message' => 'Your Request Amount is Larger Than Your Current Balance.',
            ]);
        }else{
            $tr = strtoupper(Str::random(20));
            $w['amount'] = $request->amount;
            $w['method_id'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $reAmo;
            $w['user_id'] = Auth::user()->id;
            $data['trr'] = WithdrawLog::create($w);

            return response()->json ([
                'status' => $this->successStatus,
                'data' => $data,
            ]);
        }
    }
    public function previewWithdraw($id)
    {
        $data['page_title'] = "Withdraw Method";
        $data['withdraw'] = WithdrawLog::whereTransaction_id($id)->first();
        $data['method'] = WithdrawMethod::findOrFail($data['withdraw']->method_id);
        $data['balance'] = User::findOrFail(Auth::user()->id);
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function submitWithdraw(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'withdraw_id' => 'required',
            'send_details' => 'required'
        ]);
        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $ww->amount;
        $ul['charge'] = $ww->charge;
        $ul['amount_type'] = 5;
        $ul['post_bal'] = $bal4->balance - $ww->amount;
        $ul['description'] = $ww->amount." ".$basic->currency." Withdraw Request Send. Via ".$ww->method->name;
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $ww->charge;
        $ul['charge'] = null;
        $ul['amount_type'] = 10;
        $ul['post_bal'] = $bal4->balance - ($ww->amount + $ww->charge);
        $ul['description'] = $ww->charge." ".$basic->currency." Charged for Withdraw Request. Via ".$ww->method->name;
        $ul['transaction_id'] = $ww->transaction_id;
        UserLog::create($ul);

        $bal4->balance = $bal4->balance - $ww->net_amount;
        $bal4->save();

        if ($basic->email_notify == 1){
            $text = $ww->amount." - ". $basic->currency." Withdraw Request Send via ".$ww->method->name.". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendMail($bal4->email,$bal4->name,'Withdraw Request.',$text);
        }
        if ($basic->phone_notify == 1){
            $text = $ww->amount." - ". $basic->currency." Withdraw Request Send via ".$ww->method->name.". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
            $this->sendSms($bal4->phone,$text);
        }
        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Withdraw request Successfully Submitted. Wait For Confirmation.',
        ]);

    }
    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw Log";
        $data['log'] = WithdrawLog::whereUser_id(Auth::user()->id)->whereNotIn('status',[0])->orderBy('id','desc')->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function openSupport()
    {
        $data['page_title'] = "Open Support Ticket";
        return view('user.support-open', $data);
    }
    public function submitSupport(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required'
        ]);
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

        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Support Ticket Successfully Open.',
        ]);

    }
    public function allSupport()
    {
        $data['page_title'] = "All Support Ticket";
        $data['support'] = Support::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.support-all',$data);
    }
    public function supportMessage($id)
    {
        $data['page_title'] = "Support Message";
        $data['support'] = Support::whereTicket_number($id)->first();
        $data['message'] = SupportMessage::whereTicket_number($id)->orderBy('id','asc')->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
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

        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Support Ticket Successfully Replied.',
        ]);
    }
    public function supportClose(Request $request)
    {
        $this->validate($request,[
            'support_id' => 'required'
        ]);
        $su = Support::findOrFail($request->support_id);
        $su->status = 9;
        $su->save();
        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Support Ticket Successfully Closed.',
        ]);
    }

    public function newInvest()
    {
        $data['basic_setting'] = BasicSetting::first();
        $data['page_title'] = "User New Invest";
        $data['plan'] = Plan::whereStatus(1)->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }

    public function postInvest(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        $data['page_title'] = "Investment Preview";
        $data['plan'] = Plan::findOrFail($request->id);
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }

    public function chkInvestAmount(Request $request)
    {
        $plan = Plan::findOrFail($request->plan);
        $user = User::findOrFail(Auth::user()->id);
        $amount = $request->amount;

        if ($request->amount > $user->balance){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Your Current Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
                      style="font-size:1em;"  >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }
        if( $plan->minimum > $amount){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Smaller than Plan Minimum Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg  delete_button disabled"
                     style="font-size:1em;"   >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }elseif( $plan->maximum < $amount){
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-warning"><i class="fa fa-times"></i> Amount Is Larger than Plan Maximum Amount.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-block bold uppercase btn-lg delete_button disabled"
                    style="font-size:1em;"  >
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }else{
            return '<div class="col-sm-7 col-sm-offset-4">
                <div class="alert alert-success"><i class="fa fa-check"></i> Well Done. Invest This Amount Under this Package.</div>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary bold uppercase btn-block btn-lg delete_button" style="font-size:1em;"
                        data-toggle="modal" data-target="#DelModal"
                        data-id='.$amount.'>
                    <i class="fa fa-cloud-upload"></i> Invest Amount Under This Package
                </button>
            </div>';
        }

    }

    public function submitInvest(Request $request)
    {
        $basic = BasicSetting::first();
        $request->validate([
            'amount' => 'required',
            'user_id' => 'required',
            'plan_id' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $in['trx_id'] = strtoupper(Str::random(20));
        $invest = Investment::create($in);

        $pak = Plan::findOrFail($request->plan_id);
        $com = Compound::findOrFail($pak->compound_id);
        $rep['user_id'] = $invest->user_id;
        $rep['investment_id'] = $invest->id;
        $rep['repeat_time'] = Carbon::parse()->addHours($com->compound);
        $rep['total_repeat'] = 0;
        Repeat::create($rep);

        $bal4 = User::findOrFail(Auth::user()->id);
        $ul['user_id'] = $bal4->id;
        $ul['amount'] = $request->amount;
        $ul['charge'] = null;
        $ul['amount_type'] = 14;
        $ul['post_bal'] = $bal4->balance - $request->amount;
        $ul['description'] = $request->amount." ".$basic->currency." Invest Under ".$pak->name." Plan.";
        $ul['transaction_id'] = $in['trx_id'];
        UserLog::create($ul);

        $bal4->balance = $bal4->balance - $request->amount;
        $bal4->save();

        $trx = $in['trx_id'];

        if ($basic->email_notify == 1){
            $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
            $this->sendMail($bal4->email,$bal4->name,'New Investment',$text);
        }
        if ($basic->phone_notify == 1){
            $text = $request->amount." - ". $basic->currency." Invest Under ".$pak->name." Plan. <br> Transaction ID Is : <b>#$trx</b>";
            $this->sendSms($bal4->phone,$text);
        }

        return response()->json ([
            'status' => $this->successStatus,
            'message' => 'Investment Successfully Completed.',
        ]);
    }

    public function historyInvestment()
    {
        $data['page_title'] = "Invest History";
        $data['history'] = Investment::whereUser_id(Auth::user()->id)->orderBy('id','desc')->get();
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }

    public function repeatLog()
    {
        $data['user'] = User::findOrFail(Auth::user()->id);
        $data['page_title'] = 'All Repeat';
        $data['log'] = RepeatLog::whereUser_id(Auth::user()->id)->orderBy('id','desc')->paginate(15);
        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
    public function userReference()
    {
        $data['page_title'] = "Reference User";
        $data['user'] = User::whereUnder_reference(Auth::user()->id)->orderBy('id','desc')->get();

        return response()->json ([
            'status' => $this->successStatus,
            'data' => $data,
        ]);
    }
}