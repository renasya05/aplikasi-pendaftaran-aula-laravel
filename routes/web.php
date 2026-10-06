<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;


/*
|--------------------------------------------------------------------------
| Halaman Umum
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');


Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.process');


Route::get(
    '/register',
    [AuthController::class, 'showRegister']
)->name('register');


Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register.process');


Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');



/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard User
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Daftar Aula
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/aulas',
        [DashboardController::class, 'aulas']
    )->name('aulas');



    /*
    |--------------------------------------------------------------------------
    | Pendaftaran Aula
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Cek Ketersediaan Waktu
    |--------------------------------------------------------------------------
    |
    | Route ini harus diletakkan sebelum
    | /pendaftaran/{aula}
    |
    */

    Route::get(
        '/pendaftaran/availability/check',
        [PendaftaranController::class, 'availability']
    )->name('pendaftaran.availability');


    /*
    |--------------------------------------------------------------------------
    | Form Pendaftaran
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pendaftaran/{aula}',
        [PendaftaranController::class, 'create']
    )->name('pendaftaran.create');


    /*
    |--------------------------------------------------------------------------
    | Simpan Pendaftaran
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/pendaftaran',
        [PendaftaranController::class, 'store']
    )->name('pendaftaran.store');


    /*
    |--------------------------------------------------------------------------
    | Riwayat Pendaftaran User
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat-pendaftaran',
        [PendaftaranController::class, 'history']
    )->name('pendaftaran.history');


    /*
    |--------------------------------------------------------------------------
    | Detail Pendaftaran User
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat-pendaftaran/{pendaftaran}',
        [PendaftaranController::class, 'show']
    )->name('pendaftaran.show');

});



/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');



    /*
    |--------------------------------------------------------------------------
    | Data Aula
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/aulas',
        [AdminController::class, 'aulas']
    )->name('admin.aulas');


    Route::get(
        '/admin/aulas/create',
        [AdminController::class, 'createAula']
    )->name('admin.aulas.create');


    Route::post(
        '/admin/aulas',
        [AdminController::class, 'storeAula']
    )->name('admin.aulas.store');


    Route::get(
        '/admin/aulas/{aula}',
        [AdminController::class, 'showAula']
    )->name('admin.aulas.show');


    Route::get(
        '/admin/aulas/{aula}/edit',
        [AdminController::class, 'editAula']
    )->name('admin.aulas.edit');


    Route::put(
        '/admin/aulas/{aula}',
        [AdminController::class, 'updateAula']
    )->name('admin.aulas.update');


    Route::delete(
        '/admin/aulas/{aula}',
        [AdminController::class, 'destroyAula']
    )->name('admin.aulas.destroy');



    /*
    |--------------------------------------------------------------------------
    | Pendaftaran Admin
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/history',
        [AdminController::class, 'history']
    )->name('admin.history');


    Route::get(
        '/admin/pendaftaran/{pendaftaran}',
        [AdminController::class, 'show']
    )->name('admin.pendaftaran.show');


    Route::put(
        '/admin/pendaftaran/{pendaftaran}/approve',
        [AdminController::class, 'approve']
    )->name('admin.pendaftaran.approve');


    Route::put(
        '/admin/pendaftaran/{pendaftaran}/reject',
        [AdminController::class, 'reject']
    )->name('admin.pendaftaran.reject');



    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin/laporan',
        [AdminController::class, 'laporan']
    )->name('admin.laporan');

});