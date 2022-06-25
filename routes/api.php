<?php

use Illuminate\Support\Facades\Route;


Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::prefix('public')->group(function () {
    Route::get('info', 'API\CsInformasiController@info');
    Route::get('faq', 'API\CsInformasiController@faq');
    Route::get('teman-angkatan', 'API\CsInformasiController@temanAngkatan');
    Route::get('hari-pendaftaran', 'API\CsInformasiController@hariPendaftaranDibuka');
    Route::get('jurusan', 'API\CsInformasiController@jurusan');
    Route::get('posisi', 'API\CsInformasiController@posisi');
    Route::get('jabatan', 'API\CsInformasiController@jabatan');
});

Route::middleware(['auth:api'])->prefix('main')->group(function () {
    Route::get('info', 'API\CsInformasiController@info');
    Route::get('kegiatan', 'API\CsInformasiController@kegiatan');
    Route::get('group-wa', 'API\CsInformasiController@groupWa');
});
