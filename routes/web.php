<?php

//use JWTAuth AS JWTAuth;
//use Tymon\JWTAuth\JWTException;
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');
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

Route::get('/', 'UserController@index');

