<?php

namespace App\Traits;


use App\BasicSetting;
use App\GeneralSetting;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait MailTrait
{
    public function sendMail($email,$name,$subject,$text){
        $basic = BasicSetting::first();
        $body = $basic->email_body;
        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->from_email,
            'g_title' => $basic->title,
            'subject' => $subject,
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->from_email);
        Config::set('mail.name',$basic->title);

        $body = $basic->email_body;
        $body = str_replace("{{name}}",$name,$body);
        $body = str_replace("{{message}}",$text,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }
//    public function sendSms($to,$text){
//        $basic = BasicSetting::first();
//        $appi = $basic->smsapi;
//        $text = urlencode($text);
//        $appi = str_replace("{{number}}",$to,$appi);
//        $appi = str_replace("{{message}}",$text,$appi);
//        $result = file_get_contents($appi);
//    }

//    public function sendContact($email,$name,$subject,$text,$phone)
//    {
//        $basic = BasicSetting::first();
//        $body = $basic->email_body;
//        $mail_val = [
//            'email' => $email,
//            'name' => $name,
//            'g_email' => $basic->from_email,
//            'g_title' => $basic->title,
//            'subject' => 'Contact Message - '.$subject,
//        ];
//        Config::set('mail.driver','mail');
//        Config::set('mail.from',$basic->from_email);
//        Config::set('mail.name',$basic->title);
//
//        $body = $basic->email_body;
//        $body = str_replace("Hi",'Hi. I\'m',$body);
//        $body = str_replace("{{name}}",$name." - ".$phone,$body);
//        $body = str_replace("{{message}}",$text,$body);
//
//        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
//            $m->from($mail_val['email'], $mail_val['name']);
//            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['subject']);
//        });
//    }
    public function userPasswordReset($email)
    {
        $basic = GeneralSetting::first();
        $user = User::whereEmail($email)->first();
        $mail_val = [
            'email' => $email,
            'name' => $user->name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => 'Password Reset Request',
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$basic->email);
        Config::set('mail.name',$basic->title);

        $reset = DB::table('password_resets')->whereemail($email)->count();
        $token = Str::random(40);
        $bToken = bcrypt($token);
        $otp = sprintf("%04d", mt_rand(1, 9999));
        $user->otp_code = $otp;
        $user->update();
        if ($reset == 0)
        {
            DB::table('password_resets')->insert(
                ['email' => $email, 'token' => $bToken]
            );
            $url = route('password.reset',$token);
            Mail::send('emails.reset-password', ['name' => $user->name,'link'=>$url,'otp'=>$otp,'footer'=>$basic->copy_text,'site_title'=> $basic->title], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
//            Mail::send('emails.reset-email', ['name' => $user->name,'link'=>$url,'footer'=>$basic->copy_text,'site_title'=> $basic->title], function ($m) use ($mail_val) {
//                $m->from($mail_val['g_email'], $mail_val['g_title']);
//                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
//            });
        }else{
            $user = User::whereEmail($email)->first();
            DB::table('password_resets')
                ->where('email', $email)
                ->update(['email' => $email, 'token' => $bToken]);
            $url = route('password.reset',$token);
            Mail::send('emails.reset-password', ['name' => $user->name,'link'=>$url,'otp'=>$otp,'footer'=>$basic->copy_text,'site_title'=> $basic->title], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
        }
        return $bToken;
    }

    public function send2FAEmail($thisUser)
    {
        $general = GeneralSetting::first();

        $hh  = ['s_title'=>$general->title,'s_footer'=>$general->footer_bottom_text];

        $mail_val = [
            'email' => $thisUser['email'],
            'name' => $thisUser['name'],
            'g_email' => $general->email,
            'g_title' => $general->title,
            'subject' => '2FA Activation',
        ];
        Config::set('mail.driver','mail');
        Config::set('mail.from',$general->email);
        Config::set('mail.name',$general->title);
        Mail::send('emails.otp', ['email' =>$thisUser['email'] ,'otp'=>$thisUser['otp_code'],'site_title'=>$hh['s_title'],'site_footer'=>$hh['s_footer']], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });

    }

}