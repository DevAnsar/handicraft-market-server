<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/app')->group(function () {
    Route::get('/index',[IndexController::class,'index']);
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/products/{product_id}',[ProductController::class,'get_product']);
});
