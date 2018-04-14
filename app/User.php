<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email', 'password','dob','gender','remember_token','status','role','is_verified','last_sign_in_at'
    ];
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profiles()
    {
        return $this->hasOne('App\Model\Profile','user_id'); 
    }
    public function education()
    {
        return $this->hasMany('App\Model\Education','user_id');
    }
    public function workexperiences()
    {
        return $this->hasMany('App\Model\Workexperience','user_id');
    }
    public function posts()
    {
        return $this->hasMany('App\Model\Post','user_id');
    }
}
