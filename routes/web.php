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

        Route::resource('angkatan', AngkatanController::class);
        Route::resource('pendaftaran', PendaftaranController::class);

        Route::get('change-password', 'DashboardController@changePassword')->name('change-password');
        Route::post('change-password', 'DashboardController@changePassword')->name('process-change-password');
    });
});
