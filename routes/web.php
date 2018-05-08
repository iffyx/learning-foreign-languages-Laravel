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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index');

//Route::resource('roles','RoleController');

//Route::resource('sets','SetController');
Route::get('learning1/{id}/{language}', ['as' => 'learning1', 'uses' => 'SetController@learning1']);
Route::get('learning2/{id}/{language}', ['as' => 'learning2', 'uses' => 'SetController@learning2']);
Route::get('learning3/{id}/{language}', ['as' => 'learning3', 'uses' => 'SetController@learning3']);
Route::get('learning4/{id}/{language}', ['as' => 'learning4', 'uses' => 'SetController@learning4']);
Route::get('test/{id}/{language}', ['as' => 'test', 'uses' => 'SetController@test']);
Route::post('result', ['as' => 'result', 'uses' => 'SetController@result']);
Route::resource('results','ResultController');


Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getView']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::resource('users','UserController');
    Route::get('permissions/{p}/{id1}/{id2}',['as' => 'perm', 'uses' => 'PermissionController@update']);
    //Route::get('learning3/{id}/{language}', ['as' => 'learning3', 'uses' => 'SetController@learning3']);
    Route::resource('permissions','PermissionController')->except('update');
    Route::resource('roles','RoleController');
    Route::resource('categories','CategoryController');
    Route::resource('subcategories','SubcategoryController');
});

Route::group(['middleware' => 'admin' or 'editor' or 'supereditor'], function()
{
    Route::resource('sets','SetController');
});



/*if(Auth::user()->hasRole('admin')){
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('categories','CategoryController');
    Route::resource('subcategories','SubcategoryController');
    Route::resource('sets','SetController');
}*/
/*Route::group(['middleware' => 'admin'], function () {
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('categories','CategoryController');
    Route::resource('subcategories','SubcategoryController');
    Route::resource('sets','SetController');
});*/

/*Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('categories','CategoryController');
    Route::resource('subcategories','SubcategoryController');
    Route::resource('sets','SetController');
});*/



/*Route::get('/admin', function(){
    echo "Hello Admin";
})->middleware('auth','admin');

Route::get('/user', function(){
    echo "Hello Agent";
})->middleware('auth','user');*/