<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JoueurAdminController;
use App\Http\Controllers\Admin\CategorieAdminController;
use App\Http\Controllers\Admin\StaffTechniqueAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ActualiteAdminController;
use App\Http\Controllers\Admin\MediaAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;



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



use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;


// TODO plus tard : vraie auth admin (login/logout middleware)

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard simple
    Route::get('/', function () {
        return redirect()->route('admin.properties.index');
    })->name('dashboard');

    // CRUD biens
    Route::resource('properties', AdminPropertyController::class);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.properties.index'))
            ->name('dashboard');

        Route::resource('properties', AdminPropertyController::class);
    });

