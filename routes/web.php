<?php

/*mahasiswa*/
Route::get('/', 'Auth\LoginController@viewLogin');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');

Route::middleware('checklogin')->group(function () {

	/*Administrator*/
	Route::get('backoffice','Admin\AdminController@viewBeranda');


	Route::get('backoffice/proyek','Admin\ProyekController@viewProyek');
	Route::post('backoffice/proyek/tambah','Admin\ProyekController@postAddProyek');
	Route::get('backoffice/proyek/detail/{id}','Admin\ProyekController@viewDetailProyek');

	//suplier
	Route::get('backoffice/suplier','Admin\SuplierController@viewSuplier');
	// Route::post('backoffice/suplier/tambah','Admin\SuplierController@postAddSuplier');
		// Route::post('backoffice/suplier/edit','Admin\SuplierController@postEditSuplier');
	// Route::get('backoffice/suplier/hapus.{id}','Admin\SuplierController@postDeleteSuplier');

	Route::get('backoffice/suplier/{id}','Admin\SuplierController@viewDetailSuplier');//detail suplier
	Route::get('backoffice/suplier/proyek/{id_suplier}/{id_proyek}','Admin\SuplierController@viewDetailProyekSuplier');//detail proyek suplier

	//kontak
	Route::get('backoffice/kontak','Admin\KontakController@viewKontak');
	// Route::post('backoffice/kontak/tambah','Admin\KontakController@postAddKontak');
	// Route::get('backoffice/kontak/edit.{id}','Admin\KontakController@viewEditKontak');
	// 	Route::post('backoffice/kontak/edit','Admin\KontakController@postEditKontak');
	// Route::get('backoffice/kontak/hapus.{id}','Admin\KontakController@postDeleteKontak');


	Route::get('backoffice/user','Admin\UserController@viewUser');
		

	Route::get('backoffice/akun','Admin\AkunController@viewAkun');
	// Route::post('backoffice/akun/data','Admin\AkunController@postEditAkun');
	// Route::post('backoffice/akun/gantipassword','Admin\AkunController@postEditGantiPassword');
});
