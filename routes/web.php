<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;


/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Módulo Vehículos (CRUD visual)
|--------------------------------------------------------------------------
*/

Route::get('/vehiculos', function () {
    return view('vehiculos.index');
})->name('vehiculos.index');


Route::get('/vehiculos/create', function () {
    return view('vehiculos.create');
})->name('vehiculos.create');


Route::get('/vehiculos/{id}', function ($id) {
    return view('vehiculos.show', compact('id'));
})->name('vehiculos.show');


Route::get('/vehiculos/{id}/edit', function ($id) {
    return view('vehiculos.edit', compact('id'));
})->name('vehiculos.edit');


/*
|--------------------------------------------------------------------------
| Módulo Servicios (Pantalla 2)
|--------------------------------------------------------------------------
*/

Route::get('/vehiculos/{id}/servicios', [VehiculoController::class, 'detallesServicios'])
    ->name('servicios.detalles');



/*
|--------------------------------------------------------------------------
| Backend Vehículos
|--------------------------------------------------------------------------
*/

Route::get('/vehiculos', [VehiculoController::class, 'index']);


Route::post('/vehiculos', [VehiculoController::class, 'store']);


Route::get('/vehiculos/{id}', [VehiculoController::class, 'show']);


Route::put('/vehiculos/{id}', [VehiculoController::class, 'update']);


Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy']);

Route::get('/vehiculos/{id}/nuevo-mantenimiento', function ($id) {
    return view('vehiculos.nuevo-mantenimiento', compact('id'));
})->name('mantenimiento.nuevo');

Route::get('/vehiculos/{id}/nuevo-mantenimiento', [VehiculoController::class, 'nuevoMantenimiento'])
    ->name('mantenimiento.nuevo');