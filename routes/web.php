<?php

use Illuminate\Support\Facades\Route;

// Rama 1
Route::get('/', function () { return view('login'); })->name('login');
Route::get('/home', function () { return view('home'); })->name('home');

// Rama 2
Route::get('/mantenimiento', function () { return view('mantenimiento'); });

// Rama 3
Route::get('/alertas', function () { return view('alertas'); });

// Rama 4
Route::get('/maestros', function () { return view('maestros'); });