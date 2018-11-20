<?php

/*
----------USER----------
Unggah Desain
PakaianController@create    --99
PakaianController@store 		--99

Pesan Pakaian
PemesananController@create 	--90
PemesananController@store 	--90

Verifikasi Pembayaran
PemesananController@edit   	--90
PemesananController@update 	--90

Lihat Status Pemesanan
PemesananController@show 		--90

----------ADMIN----------
Lihat Daftar Pemesanan
PemesananController@daftarPemesanan		--90

Terima Pembayaran
PemesananController@terimaPembayaran  --90

Kirim Barang
PemesananController@kirimBarang		--90
 */

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin auth
Route::group(['prefix' => 'admin'], function () {
	Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.home');
});

// Admin routes
Route::get('/daftarPemesanan', 'PemesananController@daftarPemesanan')->name('pemesanan.daftarPemesanan')->middleware('auth:admin');
Route::get('/terimaPembayaran/{pemesanan}', 'PemesananController@terimaPembayaran')->name('pemesanan.terimaPembayaran')->middleware('auth:admin');
Route::patch('/kirimBarang/{pemesanan}', 'PemesananController@kirimBarang')->name('pemesanan.kirimBarang')->middleware('auth:admin');

// User routes
Route::resource('/pakaian', 'PakaianController', [
	'only' => ['index', 'show', 'create', 'store'],
])->middleware('auth');
Route::resource('/pemesanan', 'PemesananController')->middleware('auth');
