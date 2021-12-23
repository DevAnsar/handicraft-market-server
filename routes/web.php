<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', [IndexController::class,'welcome']);
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function (){

    Route::get('/',[IndexController::class,'dashboard'])->name('dashboard');
//    custom_route('orders',OrderController::class);
    custom_route('categories',CategoryController::class);
    custom_route('users',UserController::class);
    Route::post('users/{user_id}/category/store',[UserController::class,'store_category'])->name('users.category.sync');

    custom_route('products',ProductController::class);
    Route::post('/products/{id}/image-upload',[ProductController::class,'image_uploader']);
    Route::delete('/products/image-destroy/{image_id}',[ProductController::class,'image_destroy']);
    Route::put('/products/{id}/image-main/{image_id}',[ProductController::class,'image_main']);

    custom_route('keys',IndexController::class);



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
