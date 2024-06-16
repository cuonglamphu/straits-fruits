<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FruitController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//category routes
Route::get('categories', [CategoryController::class, 'index']);
Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories/{id}', [CategoryController::class, 'show']);

//fruit routes
Route::get('fruits', [FruitController::class, 'index']);
Route::post('fruits', [FruitController::class, 'store']);
Route::get('fruits/{id}', [FruitController::class, 'show']);
Route::get('fruits/category/{id}', [FruitController::class, 'getFruitByCategory']);

//invoice routes
Route::get('invoices', [InvoiceController::class, 'index']);
Route::post('invoices', [InvoiceController::class, 'store']);
Route::get('invoices/{id}', [InvoiceController::class, 'show']);
Route::put('invoices/{id}', [InvoiceController::class, 'update']);
Route::delete('invoices/{id}', [InvoiceController::class, 'destroy']);
Route::get('invoices/detail/{id}', [InvoiceController::class, 'getInvoiceItems']);
