<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradingActivityDetails extends Model
{
    protected $table = 'trading_activity_details';

    protected $fillable = [
      'balance','date'
    ];
}
