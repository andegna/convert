<?php

Route::group(['middleware' => ['web']], function () {
    Route::controller('/', 'FrontEndController');
});
