<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveTrade extends Model
{
    protected $table = 'live_trades';
    protected $fillable =['user_id','wallet_id','currency','symbol','amount','in_time','in_amount','high_low','result','status'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function userwallet()
    {
        return $this->belongsTo(UserWallet::class,'wallet_id');
    }
}
