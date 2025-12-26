<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    
    // Routes publiques (pour React front)
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/properties/{property}', [PropertyController::class, 'show']);
    Route::post('/contact', [ContactController::class, 'store']);
    
    // Routes admin (protégées plus tard)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::apiResource('admin/properties', PropertyController::class);
    });
});
// Auth admin (API token)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Routes admin protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('admin/properties', PropertyController::class);
});