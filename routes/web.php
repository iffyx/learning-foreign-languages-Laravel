<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'WelcomeController@index');

Route::resource('roles','RoleController');
//Route::resource('sets','SetController');
Route::get('learning1/{id}', ['as' => 'learning1', 'uses' => 'SetController@learning1']);
Route::get('learning2/{id}', ['as' => 'learning2', 'uses' => 'SetController@learning2']);
Route::get('learning3/{id}', ['as' => 'learning3', 'uses' => 'SetController@learning3']);
Route::get('test1/{id}', ['as' => 'test1', 'uses' => 'SetController@test1']);
Route::get('test2/{id}', ['as' => 'test2', 'uses' => 'SetController@test2']);
Route::post('result', ['as' => 'result', 'uses' => 'SetController@result']);


Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getView']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/admin', function(){
    echo "Hello Admin";
})->middleware('auth','admin');

Route::get('/user', function(){
    echo "Hello Agent";
})->middleware('auth','user');*/