<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $table = 'plan_type';

    protected $fillable = ['name','status'];

}
