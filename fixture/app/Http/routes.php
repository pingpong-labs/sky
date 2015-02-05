<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function ()
{
	return 'Hello World!';
});

Route::post('/post/data', function ()
{
	$rules = [
		'username' => 'required',
		'password' => 'required',
	];

	$validation = Validator::make($data = Input::all(), $rules);

	if($validation->fails())
	{
		throw new RuntimeException("Validation failed");
	}

	return $data;
});