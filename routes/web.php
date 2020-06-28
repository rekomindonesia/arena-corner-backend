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

Route::get('/list_transaksi', 'TransaksiController@index');
Route::get('/transaksi/edit/{id_transaksi}','TransaksiController@edit');
Route::put('/transaksi/update/{id_transaksi}','TransaksiController@update');
Route::get('/transaksi/hapus/{id_transaksi}','TransaksiController@hapus');
Route::get('/list_bukti', 'BuktiController@index');
// Route::group(['middleware' => 'auth'], function() {
// Route::resource('transaksi', 'TransaksiController');
// });
