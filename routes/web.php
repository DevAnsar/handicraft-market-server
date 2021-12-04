<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->as('admin.')->middleware('auth')->group(function (){

    Route::get('/dashboard',[IndexController::class,'dashboard'])->name('dashboard');
//    custom_route('orders',OrderController::class);
    custom_route('categories',CategoryController::class);
    custom_route('users',UserController::class);
//    custom_route('products',ProductController::class);
//    custom_route('keys',IndexController::class);


});
