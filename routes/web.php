<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\manageInvoicesController;
use App\Http\Controllers\pdfController;

// Routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('invoice');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/categoryregis', function () {
        return view('category');
    })->name('categoryregis');

    Route::get('/fruitregis', function () {
        return view('fruit');
    })->name('fruitregis');

    Route::get('/newinvoice', function () {
        return view('invoice');
    })->name('newinvoice');

    Route::get('/manageinvoices', function () {
        return view('manageInvoices');
    })->name('manageinvoices');

    // pdf with id route
    Route::get('/pdf/{id}', [pdfController::class, 'index'])->name('pdf');

    // manage invoices route
    Route::get('/manageinvoices', [manageInvoicesController::class, 'index'])->name('manageinvoices');

    // get table data route
    Route::get('/getTableData', [manageInvoicesController::class, 'getTableData'])->name('getTableData');

    // edit invoice
    Route::get('/invoices/{id}/edit', [manageInvoicesController::class, 'edit'])->name('invoices.edit');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
