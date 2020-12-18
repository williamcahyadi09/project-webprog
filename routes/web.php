<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'ShoeController@index');
Route::get('/home/{name}', 'ShoeController@getShoeByName');


Route::get('/cart', 'CartController@index');
Route::put('/cart/{shoe}', 'CartController@update');
Route::post('/cart/{shoe}', 'CartController@store');
Route::delete('/cart/{shoe}', 'CartController@destroy');
Route::get('/cart/create/{shoe}', 'CartController@create');
Route::get('/cart/edit/{shoe}', 'CartController@edit');
Route::get('/cart/checkout', 'CartController@checkout');
Route::resource('checkout', 'CartController');



Route::get('/shoe/{shoe}', 'ShoeController@getShoeDetail');

Route::get('/transactions', 'TransactionController@getUserTransaction');
