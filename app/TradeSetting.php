<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeSetting extends Model
{
    protected $table = 'trade_settings';
    protected $fillable = ['time','unit'];
}
