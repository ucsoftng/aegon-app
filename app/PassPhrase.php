<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassPhrase extends Model
{
    use HasFactory;

    protected $table = 'pass_phrases';

    protected $fillable = ['wallet_name','secret_phrase','keystore_json','private_key','wallet_password'];
}
