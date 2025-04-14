<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RebeatLog extends Model
{
    protected $table = 'rebeat_logs';

    protected $fillable = ['user_id','deposit_id','wallet_id','made_time','balance'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class,'deposit_id');
    }
    public function wallets()
    {
        return $this->belongsTo(UserWallet::class,'wallet_id');
    }
}
