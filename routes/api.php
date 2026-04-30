<?php

use App\Http\Controllers\ControlloController;
use Illuminate\Support\Facades\Route;

// Rotta per l'aggiornamento massivo
Route::post('/update-directory', [ControlloController::class, 'updateBuffer']);