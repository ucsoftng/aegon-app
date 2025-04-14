<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundLog extends Model
{
    protected $table = 'fund_logs';

    protected $fillable = ['user_id','payment_type','fix','percent','crypto_amount','usd_amount','crypto_wallet','transaction_id','rate','amount','status','confirm_time'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function wallet()
    {
        return $this->belongsTo(PaymentWallet::class,'payment_type');
    }
}
