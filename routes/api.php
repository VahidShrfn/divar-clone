<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingAddressController;
use App\Http\Controllers\SettingCategoryController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::prefix('add-product')
        ->controller(AddProductController::class)
        ->group(function (){
            Route::post('/','create');
            Route::get('/','get');
            Route::get('/{id}','show');
            Route::patch('/{id}','updatePrice');
        });
});
Route::prefix('auth')
    ->controller(AuthController::class)->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
Route::prefix('products')
    ->controller(ProductController::class)
    ->group(function (){
        Route::get('/','get');
        Route::get('/{id}','show');
    });
Route::prefix('settings')
    ->group(function (){
        Route::prefix('address')
            ->controller(SettingAddressController::class)
            ->group(function (){
                Route::get('/','get');
                Route::get('/{id}','show');
            });
        Route::prefix('category')
            ->controller(SettingCategoryController::class)
            ->group(function (){
                Route::get('/','get');
            });
    });
Route::prefix('products')
    ->controller(ProductController::class)
    ->group(function (){
        Route::get('/','get');
        Route::get('/{id}','show');
    });

