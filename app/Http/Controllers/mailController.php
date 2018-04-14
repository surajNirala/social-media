<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class mailController extends Controller
{
    public function send(){

    	Mail::send(['text'=>'mail'],['name','surajNirala'],function($message){
    		$message->to('suraj@yopmail.com')->subject('Test Email');
    		$message->from('suraj.nirala1995@gmail.com','surajNirala');
    	});
    }
}
