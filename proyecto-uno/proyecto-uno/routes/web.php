<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('home.home');
})->name('home');

Route::get('productos/pdf/{id}',[ProductController::class, 'pdf'])->name('pdf');
Route::get('movimientos/pdf-mov/{id}',[MovementController::class, 'pdf'])->name('pdf-mov');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('productos', ProductController::class);
Route::resource('movimientos', MovementController::class);
Route::resource('proveedores',SupplierController::class);

