<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
define('ADMIN',config('enums.roles')['ADMIN']);
define('MEMBER',config('enums.roles')['MEMBER']);

Auth::routes();
Route::post('/login','Auth\LoginController@loginWithRemember')->name('login.withRemember');
Route::get('/', 'ShoeController@index');
Route::get('/home', 'ShoeController@index')->name('home');
Route::get('/home/{name}', 'ShoeController@getShoeByName');

Route::middleware(['auth.guard', 'role.guard:'.ADMIN])->group(function () {
    Route::get('/shoe/create', 'ShoeController@create');
    Route::post('/shoe/create', 'ShoeController@store');
    Route::get('/shoe/edit/{shoe}', 'ShoeController@edit');
    Route::patch('/shoe/{shoe}', 'ShoeController@update');
});

Route::get('/shoe/{shoe}', 'ShoeController@getShoeDetail')->name('shoe_detail');

Route::middleware(['auth.guard', 'role.guard:'.MEMBER])->group(function () {
    Route::get('/cart', 'CartController@index');
    Route::put('/cart/{shoe}', 'CartController@update');
    Route::post('/cart/{shoe}', 'CartController@store');
    Route::delete('/cart/{shoe}', 'CartController@destroy');
    Route::get('/cart/create/{shoe}', 'CartController@create');
    Route::get('/cart/edit/{shoe}', 'CartController@edit');
    Route::get('/cart/checkout', 'CartController@checkout'); 
});

Route::middleware(['auth.guard'])->group(function () {
    Route::get('/transactions', 'TransactionController@getUserTransaction');
});
