<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repeat extends Model
{
    protected $table = 'repeats';

    protected $fillable = ['user_id','deposit_id','wallet_id','repeat_time','made_time','status'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class,'deposit_id');
    }
    public function wallets()
    {
        return $this->belongsTo(UserWallet::class,'wallet_id');
    }
}
