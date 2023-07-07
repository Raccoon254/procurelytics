<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcurementDataController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpendCategoryController;

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

Route::get('/procurement/create', [ProcurementDataController::class, 'create'])->name('procurement.create');

Route::resource('categories', CategoryController::class);
Route::resource('spend-categories', SpendCategoryController::class);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/spend-categories', [SpendCategoryController::class, 'index'])->name('spend.index');

Route::post('/procurement/store', [ProcurementDataController::class, 'store'])->name('procurement.store');

Route::get('/procurement/success', function () {
    return view('procurement.success');
})->name('procurement.success');

Route::get('/procurement/', function () {
    return view('procurement.index');
})->name('procurement-data');

