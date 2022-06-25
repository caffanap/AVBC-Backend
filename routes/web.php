<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/admin/login');

Route::prefix('auth')->group(function () {
    Route::post('/login', 'AuthenticationController@authenticate');
    Route::get('/logout', 'AuthenticationController@logout');
});

Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/login');
    Route::get('/login', 'AuthenticationController@login')->name('admin/login');

    Route::middleware(['auth:web'])->as('admin.')->group(function () {
        Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

        Route::get('anggota', 'PenggunaDetailController@index')->name('anggota.index');
        Route::post('anggota', 'PenggunaDetailController@store')->name('anggota.store');
        Route::delete('anggota/{id}', 'PenggunaDetailController@destroy');
        Route::get('anggota/{id}', 'PenggunaDetailController@show');
        Route::post('anggota/update-jabatan', 'PenggunaDetailController@updateJabatan');

        Route::get('informasi', 'InfoController@index')->name('informasi.index');
        Route::post('informasi', 'InfoController@store')->name('informasi.store');
        Route::delete('informasi/{id}', 'InfoController@destroy');
        Route::get('informasi/{id}/edit', 'InfoController@edit');

        Route::get('kegiatan', 'KegiatanController@index')->name('kegiatan.index');
        Route::post('kegiatan', 'KegiatanController@store')->name('kegiatan.store');
        Route::delete('kegiatan/{id}', 'KegiatanController@destroy');
        Route::get('kegiatan/{id}/edit', 'KegiatanController@edit');

        
        Route::resource('angkatan', AngkatanController::class);
        Route::resource('pendaftaran', PendaftaranController::class);
        

        Route::get('change-password', 'DashboardController@changePassword')->name('change-password');
        Route::post('change-password', 'DashboardController@changePassword')->name('process-change-password');
    });
});
