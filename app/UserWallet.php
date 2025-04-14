<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $table = 'user_wallets';
    protected $fillable = ['user_id','wallet_id','wallet_short','amount_in_usd','amount_in_crypto','status'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function wallets()
    {
        return $this->belongsTo(PaymentWallet::class,'wallet_id');
    }
}
