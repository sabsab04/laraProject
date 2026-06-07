<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EventController;

Route::get('/', [PublicController::class, 'home']);
Route::view('/dove-siamo', 'dove-siamo')->name('dove-siamo');
Route::get('/eventi', [EventController::class, 'index'])->name('eventi');
Route::get('/eventi/{id}', [EventController::class, 'show'])->name('evento.dettaglio');