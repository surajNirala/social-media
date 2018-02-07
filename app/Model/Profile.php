<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     public function users()
    {
        return $this->belongsTo('App\User','id');
    }
}
