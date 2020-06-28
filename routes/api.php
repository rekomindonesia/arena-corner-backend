<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserController@details');
 	Route::get('getDataByTransaksi', 'TransaksiController@getDataByTransaksi');
    Route::resource('transaksi', 'TransaksiController');
    // Route::get('getStoreByTransaksi', 'TransaksiController@getStoreByTransaksi');
});
Route::get('status', 'StatusController@index');
Route::get('get_kategori', 'KategoriController@index');
Route::get('/getKategoriByKota', 'KategoriController@getKategoriByKota');
Route::post('kategori', 'ServiceController@create');
Route::put('/update_kategori/{id_kategori}', 'KategoriController@update');
Route::delete('/delete_service/{id_service}', 'KategoriController@destroy');
Route::get('/get_service/{id_service}', 'ServiceController@show');

Route::get('/getStoreByKategori', 'StoreController@getStoreByKategori');
Route::get('get_store', 'StoreController@index');
Route::post('store', 'StoreController@create');
Route::put('/update_store/{id_store}', 'StoreController@update');
Route::delete('/delete_store/{id_store}', 'StoreController@destroy');

Route::get('get_kota', 'KotaController@index');
Route::post('kota', 'KotaController@create');
Route::put('/update_kota/{id_kota}', 'KotaController@update');
Route::delete('/delete_kota/{id_kota}', 'KotaController@destroy');
// Route::get('/get_store/{id_store}', 'StoreController@show');

// Get::with(array('store'=>function($query){
//     $query->select('id_store','service_id');
// }))->get();

Route::get('get_bukti', 'BuktiController@index');
Route::post('tambah_bukti', 'BuktiController@create');
Route::delete('/delete_bukti/{id_bukti}', 'BuktiController@destroy');

Route::get('/gethistoriByTransaksi', 'HistoriController@gethistoriByTransaksi');
Route::get('get_histori', 'HistoriController@index');
Route::post('histori', 'HistoriController@create');
Route::put('/update_histori/{id_histori}', 'HistoriController@update');
Route::delete('/delete_histori/{id_histori}', 'HistoriController@destroy');
Route::get('/get_histori/{id_histori}', 'HistoriController@show');
// Route::post('register', 'API\UserController@register');
Route::get('getStoreById', 'TransaksiController@getStoreById');
// Route::group(['middleware' => 'auth:api'], function(){
// 	Route::post('details', 'API\UserController@details');
// // Route::middleware('auth:api')->get('/user', function (Request $request) {
// //     return $request->user();
// });
