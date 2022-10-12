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
    Route::get('/posts/search', 'search');
    Route::get('/posts', 'index');
    Route::post('/posts', 'create');
    Route::get('/posts/{slug}', 'show');
    Route::delete('/posts/{slug}', 'delete');
    Route::put('/posts/{slug}', 'update');
});

// Categorias
Route::controller(CategoryController::class)->prefix('/v1')->group(function() {
    Route::get('/categories/search', 'search');
    Route::get('/categories', 'index');
    Route::post('/categories', 'create');
    Route::get('/categories/{slug}', 'show');
    Route::delete('/categories/{slug}', 'delete');
    Route::put('/categories/{slug}', 'update');
});