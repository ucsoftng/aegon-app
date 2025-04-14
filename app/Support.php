<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'support';

    protected $fillable = ['user_id','ticket_number','subject','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
