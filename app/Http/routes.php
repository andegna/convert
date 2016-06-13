<?php

//Route::group(['middleware' => ['web']], function () {
//    Route::controller('/', 'FrontEndController');
//});

Route::get('/', function () {
    return view('app');
});
