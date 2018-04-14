
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*Route::group(['prefix'=>'v1','middleware' => 'jwt.auth'],function(){
Route::apiResource('users','v1\UserController');
});*/
//------------------------- for authorization -----------------------
Route::group(['prefix'=>'v1'],function()
{
	Route::post('register', 								  'v1\UserController@register'); 
	Route::get('verify/{verification_code}',    			  'v1\UserController@verifyUser');
	Route::post('recover',									  'v1\UserController@recover');
	Route::get('resend/{resendotp}',						  'v1\UserController@resend');
	Route::patch('resetpassword/{remember_token}',            'v1\UserController@reset_password');
	Route::post('login',                                      'v1\UserController@login');
	Route::group(['middleware' => 'jwt.auth','throttle:60,1'],function(){
		Route::apiResource('socials',                 		  'v1\UserController');
		Route::get('userinfo',								  'v1\UserController@user_info');
		Route::patch('changepassword', 						  'v1\UserController@change_password');
		Route::post('profilepic',                   		  'v1\UserController@profilepic');
		Route::post('cover_profilepic',                   	  'v1\UserController@cover_profilepic');
		Route::get('logout',                                  'v1\UserController@logout');
	});
	Route::get('emailSend','mailController@send');
});

