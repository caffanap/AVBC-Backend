<?php

use Illuminate\Support\Facades\Route;


Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::prefix('public')->group(function () {
    Route::get('info', 'API\CsInformasiController@info');
    Route::get('faq', 'API\CsInformasiController@faq');
    Route::get('teman-angkatan', 'API\CsInformasiController@temanAngkatan');
    Route::get('hari-pendaftaran', 'API\CsInformasiController@hariPendaftaranDibuka');
    
});

Route::middleware(['auth:api'])->prefix('main')->group(function () {
    Route::get('info', 'API\CsInformasiController@info');
    Route::get('group-wa', 'API\CsInformasiController@groupWa');
});