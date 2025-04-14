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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AuthenticationController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = Auth::user();
            $data['token'] =  $user->createToken('MyApp')->accessToken;
            $data['data'] = $user;
            return response()->json(['data' => $data], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|unique:users',
            'username' => 'required|min:5|unique:users|regex:/^\S*$/u',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'captcha',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $basic = BasicSetting::first();
        if ($request['under_reference'] != null){
            $reChk = User::whereReference($request['under_reference'])->count();
            if ($reChk == 0){
                $reference = 0;
            }else{
                $reference = User::whereReference($request['under_reference'])->first()->id;
            }
        }else{
            $reference = 0;
        }
        if ($basic->email_verify == 1){
            $email_verify = 0;
        }else{
            $email_verify = 1;
        }

        if ($basic->phone_verify == 1){
            $phone_verify = 0;
        }else{
            $phone_verify = 1;
        }

        $email_code = strtoupper(Str::random(6));
        $email_time = Carbon::parse()->addMinutes(2);
        $phone_code = strtoupper(Str::random(6));
        $phone_time = Carbon::parse()->addMinutes(5);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['under_reference'] = $reference;
        $input['email_verify'] = $email_verify;
        $input['email_code'] = $email_code;
        $input['email_time'] = $email_time;
        $input['phone_verify'] = $phone_verify;
        $input['phone_code'] = $phone_code;
        $input['phone_time'] = $phone_time;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;

        if ($user->under_reference != 0){
            $refUser = User::findOrFail($user->under_reference);

            $bal4 = $refUser;
            $trx = strtoupper(Str::random(20));
            $ul['user_id'] = $bal4->id;
            $ul['amount'] = $basic->reference_bonus;
            $ul['charge'] = null;
            $ul['amount_type'] = 3;
            $ul['post_bal'] = $bal4->balance + $basic->reference_bonus;
            $ul['description'] = $basic->reference_bonus." ".$basic->currency." Bonus For Reference Join. ";
            $ul['transaction_id'] = $trx;
            UserLog::create($ul);

            if ($basic->email_notify == 1){
                $text = $basic->reference_bonus." - ". $basic->currency." Bonus For Reference Join. <br> Transaction ID Is : <b>#$trx</b>";
                $this->sendMail($bal4->email,$bal4->name,'New Investment',$text);
            }
            if ($basic->phone_notify == 1){
                $text = $basic->reference_bonus." - ". $basic->currency." Bonus For Reference Join. <br> Transaction ID Is : <b>#$trx</b>";
                $this->sendSms($bal4->phone,$text);
            }
            $refUser->balance = $refUser->balance + $basic->reference_bonus;
            $refUser->save();
        }


        if ($basic->email_verify == 1)
        {
            $email_code = strtoupper(Str::random(6));
            $text = "Your Verification Code Is: <b>$email_code</b>";
            $this->sendMail($user->email,$user->name,'Your Email verification Code',$text);
            $user->email_code = $email_code;
            $user->email_time = Carbon::parse()->addMinutes(5);
            $user->save();
        }
        if ($basic->phone_verify == 1)
        {
            $email_code = strtoupper(Str::random(6));
            $txt = "Your Verification Code is: $email_code";
            $to = $user->phone;
            $this->sendSms($to,$txt);
            $user->phone_code = $email_code;
            $user->phone_time = Carbon::parse()->addMinutes(5);
            $user->save();
        }
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $data = ['message' => 'You have been successfully logged out!'];
        return response($data, 200);
    }


}