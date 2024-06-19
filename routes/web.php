<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('invoice');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


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

//pdf with id route
Route::get('/pdf/{id}', 'App\Http\Controllers\pdfController@index')->name('pdf');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
