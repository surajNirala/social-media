<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_verification extends Model
{
    protected $fillable = ['user_id','token'];
    public $timestamps = true;
}
