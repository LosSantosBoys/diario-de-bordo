<?php

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


Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

// Posts
Route::controller(PostController::class)->group(function() {
    Route::get('/posts/search', 'search');
    Route::get('/posts', 'index');
    Route::post('/posts', 'create');
    Route::get('/posts/{slug}', 'show');
    Route::delete('/posts/{slug}', 'delete');
    Route::put('/posts/{slug}', 'update');
});

// Categorias
Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories/search', 'search');
    Route::get('/categories', 'index');
    Route::post('/categories', 'create');
    Route::get('/categories/{slug}', 'show');
    Route::delete('/categories/{slug}', 'delete');
    Route::put('/categories/{slug}', 'update');
});