<?php

namespace App\Http\Helper;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidatorDob;
use Carbon\Carbon;


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
    	$dt = new Carbon();
		$before = $dt->subYears(1)->format('d-m-Y');
        return Validator::make($data, [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'dob'           => 'required|date_format:d-m-Y|before_or_equal:'.$before,
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
	            'dob'           => 'required|date_format:d-m-Y',
	            //'gender'        => 'required|max:255',
	        ]);
	}
	protected function validatorRecover(array $data)
	{
		return Validator::make($data, [
			'email'				=> 'required|string|email|max:255'
		]);
	}
	protected function validatorResetPassword(array $data){
		return Validator::make($data, [
		'password'      => 'required|string|min:6|confirmed',
		]);
	}
	protected function validatorChangePassword(array $data){
		return Validator::make($data, [
			'oldpassword'   => 'required',
			'password'      => 'required|string|min:6|confirmed',
		]);
	}
	protected function validatorImage(array $data){

    	return Validator::make($data, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
	}
	/*protected function validateLogout(array $data)
	{
		return Validator::make($data,[
			'token'            => 'required',
		]);
	}*/
}