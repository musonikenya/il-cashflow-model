<?php

Route::post('/', 'CashflowController@store');
Route::group(['middleware' => 'auth'], function()
{
    Route::resource('loansReload', 'CashflowReloadController');
});
