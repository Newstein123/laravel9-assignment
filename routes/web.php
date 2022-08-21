<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/product', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/product', [App\Http\Controllers\HomeController::class, 'create']);
// Route::post('/product', [App\Http\Controllers\HomeController::class, 'store']);
// Route::get('product/{id}/edit', [App\Http\Controller\ProductController::class, 'edit']);
// Route::get('product/{id}', [App\Http\Controller\ProductController::class, 'update']);
// Route::delete('product/{id}', [App\Http\Controller\ProductController::class, 'delete']);

Route::resources([
    'products'=> ProductController::class,
    'categories'=> CategoryController::class,
]);

