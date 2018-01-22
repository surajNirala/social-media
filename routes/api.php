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
    	Route::post('register', 'v1\UserController@register');
    	Route::post('login', 'v1\UserController@login');

    //--------------------------- After authorized--------------------	
	    Route::group(['middleware' => 'jwt.auth'],function(){
		
			Route::apiResource('users',                 'v1\UserController');
		});
	});

