<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\RegistroMaestroController;

// Endpoints Rama 1
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard/resumen', [AuthController::class, 'getResumen']);

// Endpoints Rama 2
Route::get('/mantenimientos', [MantenimientoController::class, 'index']);
Route::get('/mantenimientos/{id}', [MantenimientoController::class, 'show']);
Route::post('/mantenimientos', [MantenimientoController::class, 'store']);

// Endpoints Rama 3
Route::get('/notificaciones', [AlertaController::class, 'getNotificaciones']);
Route::get('/inventario/alertas', [AlertaController::class, 'getInventarioBajo']);

// Endpoints Rama 4
Route::post('/clientes/registrar', [RegistroMaestroController::class, 'storeCliente']);
Route::get('/mecanicos', [RegistroMaestroController::class, 'getMecanicos']);
Route::post('/mecanicos/nuevo', [RegistroMaestroController::class, 'storeMecanico']);