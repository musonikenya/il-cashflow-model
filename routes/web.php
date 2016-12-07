<?php
use App\Notifications\CashflowCreated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
///////////////////
//The construct below is to test sending of bulk notification via the channels
//deactivate log in the .env file
  $users = App\User::all();
  $models = App\Cashflow::all();
      foreach ($models as $model) {
          foreach ($users as $user) {
            $user->notify(new CashflowCreated($model));
            //print_r($user);
          }
      }
/////////////////////////
  //  return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

Route::resource('/musonikenya', 'CashflowController');
