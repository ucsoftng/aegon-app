<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentWallet extends Model
{
    protected $table = 'payment_wallets';
    protected $fillable = [
        'name',
        'short',
        'image',
        'rate',
        'crypto_rate',
        'fix',
        'tag',
        'percent',
        'api',
        'xpub',
        'wallet_1',
        'wallet_2',
        'wallet_3',
        'network',
        'status',
        ];
}
