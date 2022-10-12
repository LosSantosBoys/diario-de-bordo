<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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

// Posts
Route::controller(PostController::class)->prefix('/v1')->group(function() {
    Route::get('/posts', 'index');
    Route::post('/posts', 'create');
    Route::get('/posts/{slug}', 'show');
    Route::delete('/posts/{slug}', 'delete');
    Route::put('/posts/{slug}', 'update');
    Route::get('/posts/search/{query}', 'search');
});

// Categorias
Route::controller(CategoryController::class)->prefix('/v1')->group(function() {
    Route::get('/categories', 'index');
    Route::post('/categories', 'create');
    Route::get('/categories/{titulo}', 'show');
    Route::delete('/categories/{titulo}', 'delete');
    Route::put('/categories/{titulo}', 'update');
    Route::get('/categories/search/{query}', 'search');
});