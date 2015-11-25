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


Route::get('/', function () {
    return view('pages.home');
});

Route::get('/edit', function () {
    return view('pages.edittext');
});


Route::get('home',  function () {
    
    return view('welcome');
    
});

Route::get('faq',  function () {
    
    return view('pages.faq');
    
});

Route::get('computername',  function () {
    
    return view('pages.computername');
    
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
   'password' => 'Auth\PasswordController',
]);

Route::get('dropbox/login',"DropboxController@dropboxAuth");
Route::get('FacebookModel.php',"DropboxController@dropboxSuccess");