<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class);
Route::prefix('categories')->name('categories.')->group(function () {
    Route::post('/storeAjax', [CategoryController::class, 'storeAjax'])->name('storeAjax');
    Route::post('/{category}/status', [CategoryController::class, 'updateStatus'])->name('updateStatus');
});
