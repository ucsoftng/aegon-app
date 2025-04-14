<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    use HasFactory;

    protected $table = 'crypto_wallets';
    protected $fillable = ['name','symbol','image','rate','market_cap','market_cap_rank','high_24h','low_24h','price_change_24h','price_change_percentage_24h','market_cap_change_24h','market_cap_change_percentage_24h'];
}
