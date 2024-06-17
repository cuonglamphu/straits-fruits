<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\UnitController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//category routes
Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

//fruit routes
Route::get('fruits', [FruitController::class, 'index'])->name('fruits');
Route::post('fruits', [FruitController::class, 'store'])->name('fruits.store');
Route::get('fruits/{id}', [FruitController::class, 'show'])->name('fruits.show');
Route::get('fruits/category/{id}', [FruitController::class, 'getFruitByCategory'])->name('fruits.category');

//unit routes
Route::get('units', [UnitController::class, 'index'])->name('units');
Route::post('units', [UnitController::class, 'store'])->name('units.store');
Route::get('units/{id}', [UnitController::class, 'show'])->name('units.show');
Route::put('units/{id}', [UnitController::class, 'update'])->name('units.update');

//invoice routes
Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::put('invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
Route::get('invoices/detail/{id}', [InvoiceController::class, 'getInvoiceItems'])->name('invoices.detail');
