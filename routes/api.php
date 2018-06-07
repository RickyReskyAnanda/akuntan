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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Tempat
Route::get('bukubesar/kode/{id_proyek}', 'Admin\ProyekController@getKode');
Route::post('bukubesar/kode/tambah', 'Admin\ProyekController@postAddKode');
Route::get('bukubesar/kode/data/{id_bb}/{id_proyek}', 'Admin\ProyekController@getDataBukuBesar');
Route::get('bukubesar/kode/delete/{idBukuBesar}/{kodeBukuBesar}', 'Admin\ProyekController@postDeleteKode');

Route::post('bukubesar/jurnalumum/tambah', 'Admin\ProyekController@postAddJurnalUmum');
Route::get('bukubesar/jurnalumum/data/{id_proyek}', 'Admin\ProyekController@getDataJurnalUmum');
Route::get('bukubesar/jurnalumum/pembayaran-hutang/{id_jurnal_umum}', 'Admin\ProyekController@postDataPembayaranHutangJurnalUmum');
Route::get('bukubesar/jurnalumum/hapus/{id_jurnal_umum}', 'Admin\ProyekController@postDeleteDataJurnalUmum');
// Route::post('venue', 'VenueController@postVenue');

Route::get('backoffice/suplier/data', 'Admin\SuplierController@getDataSuplier');
Route::post('backoffice/suplier/tambah', 'Admin\SuplierController@postAddSuplier');
Route::get('backoffice/suplier/detail/data/{id_suplier}', 'Admin\SuplierController@getDetailSuplier');
Route::get('backoffice/suplier/proyek/data/{id_suplier}/{id_proyek}', 'Admin\SuplierController@getDataJurnalUmumSuplier');

Route::get('backoffice/user/data', 'Admin\UserController@getDataUser');
Route::post('backoffice/user/tambah', 'Admin\UserController@postAddUser');
Route::get('backoffice/user/reset-password/{id_user}', 'Admin\UserController@postResetPasswordUser');
Route::get('backoffice/user/edit/{id_user}', 'Admin\UserController@getEditUser');
Route::post('backoffice/user/edit', 'Admin\UserController@postEditUser');
Route::get('backoffice/user/delete/{id_user}', 'Admin\UserController@postDeleteUser');
