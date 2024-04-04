<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\SectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->prefix('auth')->group(function(){
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
    });

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
