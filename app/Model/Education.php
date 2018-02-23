<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','id');
    }
}
