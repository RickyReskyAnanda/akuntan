<?php

Route::get('/', 'Auth\LoginController@viewLogin');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');

// Route::middleware('checklogin')->group(function () {
Route::prefix('admin')->group(function () {

	Route::get('/','HomeDashboardController@index');

	// pemantauan
	Route::get('/pemantauan','PemantauanController@index')->name('pemantauan');
	Route::get('/pemantauan/create','PemantauanController@create')->name('pemantauan.create');
	Route::post('/pemantauan/store','PemantauanController@store')->name('pemantauan.store');

	// permasalaham
	Route::get('/permasalahan','PermasalahanController@index')->name('permasalahan');

	// bukti
	Route::get('/bukti','BuktiController@index')->name('bukti');

	// pratinjau laporan
	Route::get('/pratinjau','PratinjauLaporanController@index')->name('pratinjau');

	//laporan
	Route::get('/laporan','LaporanController@index')->name('laporan');

	//user
	Route::get('/user', 'UserController@index')->name('user');

	//profil
	Route::get('/profil', 'ProfilController@index')->name('profil');
});

// });

// Route::prefix('api')->middleware('auth')->group(function () {
Route::prefix('api/admin')->group(function () {
	
	Route::get('kegiatan', 'Api\KegiatanController@index');
	// // user
	// Route::get('user', 'Api\UserController@index');
	// Route::post('user', 'Api\UserController@store');
	// Route::get('user/{user}', 'Api\UserController@show');
	// Route::put('user', 'Api\UserController@update');
	// Route::delete('user/{user}', 'Api\UserController@destroy');	

	// user
	Route::get('user', 'Api\UserController@index');
	Route::post('user', 'Api\UserController@store');
	Route::get('user/{user}', 'Api\UserController@show');
	Route::put('user', 'Api\UserController@update');
	Route::delete('user/{user}', 'Api\UserController@destroy');

});

