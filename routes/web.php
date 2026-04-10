<?php

use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/api/tasks', function () {
    #return Task::all();
});

Route::get('/elenco', [PracticeController::class, 'index'])->name("practices.index");
Route::get('/elenco/{practice}', [PracticeController::class, 'form'])->name("practices.form");
Route::get('/elenco/{practice}', [PracticeController::class, 'edit'])->name("practices.update");
Route::get('/elenco', [PracticeController::class, 'create'])->name("practices.store");
