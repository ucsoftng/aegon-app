<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradingActivity extends Model
{
    protected $table = 'trading_activity';

    protected $fillable = [
      'member_code','initial_deposit','commission','available'
    ];
}
