<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\MenuController;
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

    Route::get('/product/{productId}', [ProductController::class, 'getProduct']);

    Route::controller(SectionController::class)->group(function () {
        Route::get('/sections', 'getSections');

        Route::prefix('/section/{sectionId}')->group(function () {
            Route::get('/children', 'getChildSections');
            Route::get('/products', 'getProducts');
        });
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('menus', 'getMenus');
        Route::get('/menu/{menuKey}/items', 'getMenuItems');
    });

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
