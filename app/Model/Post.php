<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','id');
    }
    public function profiles()
    {
        return $this->belongsTo('App\Model\Profile','user_id');
    }
    

}
