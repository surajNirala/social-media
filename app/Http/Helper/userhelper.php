<?php

namespace App\Http\Helper;
use Illuminate\Support\Facades\Validator;


trait userhelper
{
	protected function validatorLogin(array $data)
	    {
	      return Validator::make($data, [
	            'email' => 'required|string|email|max:255',
	            'password' => 'required',
	        ]);
	    }
    protected function validatorRegister(array $data)
	    {
	        return Validator::make($data, [
	            'first_name'    => 'required|string|max:255',
	            'last_name'     => 'required|string|max:255',
	            'email'         => 'required|string|email|max:255|unique:users',
	            'password'      => 'required|string|min:6|confirmed',
	            'dop'           => 'required|max:255',
	            'gender'        => 'required|max:255',
	        ]);
	    }

	protected function validatorUpdate(array $data)
	{
		return Validator::make($data, [
	            'first_name'    => 'required|string|max:255',
	            'last_name'     => 'required|string|max:255',
	          //  'email'         => 'required|string|email|max:255|unique:users',
	           // 'password'      => 'required|string|min:6|confirmed',
	            'dop'           => 'required|max:255',
	            //'gender'        => 'required|max:255',
	        ]);
	}
	/*protected function validateLogout(array $data)
	{
		return Validator::make($data,[
			'token'            => 'required',
		]);
	}*/
}