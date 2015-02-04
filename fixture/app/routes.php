<?php

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