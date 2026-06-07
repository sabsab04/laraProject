<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EventController;

use App\Http\Controllers\AuthController;
Route::get('/', [PublicController::class, 'home']);
Route::view('/dove-siamo', 'dove-siamo')->name('dove-siamo');

Route::get('/eventi', [EventController::class, 'index'])->name('eventi');
Route::get('/eventi/{id}', [EventController::class, 'show'])->name('evento.dettaglio');



// Rotte login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (dopo il login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

//rotte per l'accesso

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dati-personali', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/eventimiei', function () {
    return view('eventimiei');
})->middleware('auth');

