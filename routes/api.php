<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BannerController;
use App\Http\Controllers\Api\v1\BrandController;
use App\Http\Controllers\Api\v1\MenuController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\PageController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ReviewController;
use App\Http\Controllers\Api\v1\SectionController;
use App\Http\Controllers\Api\v1\UserController;
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
    Route::controller(AuthController::class)->prefix('auth')->group(function() {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
    });

    Route::get('/reviews', [ReviewController::class, 'getReviews']);

    Route::get('/banners', [BannerController::class, 'getBanners']);

    Route::get('/product/{productId}', [ProductController::class, 'getProduct']);

    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'getBrands');

        Route::prefix('brand')->group(function () {
            Route::get('/{brandId}', 'getBrandById');
            Route::get('/{brandId}/products', 'getProductsByBrandId');
        });
    });

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

        Route::controller(ReviewController::class)->prefix('review')->group(function () {
            Route::patch('/create', 'createReview');
            Route::patch('/{reviewId}', 'editReview');
            Route::delete('/{reviewId}', 'deleteReview');
        });

        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::get('/profile', 'getUserProfile');
            Route::patch('/profile', 'updateUserProfile');
        });

        Route::controller(OrderController::class)->group(function () {
            Route::get('/orders', 'getOrders');

            Route::prefix('order')->group(function () {
                Route::post('/create', 'createOrder');
                Route::post('/{orderId}/cancel', 'cancelOrder');
            });
        });
    });

    Route::get('/getPage/{url}', [PageController::class, 'index']);
});
