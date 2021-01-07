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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pesan/{id}', 'PesanController@index');
Route::post('/pesan/{id}', 'PesanController@pesan');

// Halaman Checkout
Route::get('/checkout', 'PesanController@checkout');
Route::post('/checkout/{id}', 'PesanController@delete');
Route::post('/updateJumlah', 'PesanController@updateJumlah');
Route::get('/proses-checkout', 'PesanController@prosesCheckout');
Route::get('/history', 'PesanController@history');
Route::get('/history/{id}', 'PesanController@store');

Route::get('/profile', 'ProfileController@index');
Route::post('/simpanProfile', 'ProfileController@simpanProfile');
