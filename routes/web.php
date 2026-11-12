
<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'showLogin'])
    ->name('home');


Route::post('/login', [LoginController::class, 'login'])
    ->name('login.authenticate');


Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');



// Rutas protegidas: requieren iniciar sesión
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [
        DashboardController::class,
        'dashboard'
    ])->name('dashboard');

    Route::resource('productos', ProductController::class);

    Route::get('productos/pdf/{id}', [
        ProductController::class,
        'pdf'
    ])->name('pdf');

    Route::get('movimientos/pdf_movement/{id}', [
        MovementController::class,
        'pdf'
    ])->name('pdf_movement');

    Route::get('movimientos/pdfall', [
        MovementController::class,
        'pdfall'
    ])->name('pdfall');

    Route::resource('movimientos', MovementController::class);

    Route::resource('proveedores', SupplierController::class);
});