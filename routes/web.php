<?php

use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::resource('productos', ProductController::class);
Route::get('productos/pdf/{id}', [ProductController::class, 'pdf'])->name('pdf');
Route::get('movimientos/pdf_movement/{id}', [MovementController::class, 'pdf'])->name('pdf_movement');
Route::get('movimientos/pdfall', [MovementController::class, 'pdfall'])->name('pdfall');
Route::resource('movimientos', MovementController::class);
Route::resource('proveedores', SupplierController::class);