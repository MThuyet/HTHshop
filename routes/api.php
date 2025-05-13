<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client;
use App\Http\Controllers\Admin;

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

Route::post('/products/by-ids', [Client\ProductsController::class, 'getProductsByIds']);
Route::post('products/toggle-favorite', [Client\ProductsController::class, 'toggleFavorite'])->middleware('throttle: 40,1');
Route::get('/search/suggest', [Client\ProductsController::class, 'suggestProducts']);

Route::middleware(['auth'])->group(function () {
	Route::middleware(['auth.admin'])->group(function () {
		Route::get('/favorite-products', [Admin\DashBoardController::class, 'getFavoriteProducts']);
	});
});
