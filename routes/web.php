<?php

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\OpenwebController;
use App\Http\Controllers\ControlloController;
use Illuminate\Support\Facades\Route;



Route::get('/api/tasks', function () {
    #return Task::all();
});

/*
<<<<<<< HEAD
Route::get('/elenco', [PracticeController::class, 'index'])->name("practices.index");
Route::get('/elenco/{practice}', [PracticeController::class, 'form'])->name("practices.form");
Route::get('/elenco/{practice}', [PracticeController::class, 'edit'])->name("practices.update");
Route::get('/elenco', [PracticeController::class, 'create'])->name("practices.store");
=======

Route::resource('posts', PostController::class);
*/

Route::get('/', [OpenwebController::class, 'index'])->name("openweb.index");
Route::get('/show/{practice}', [OpenwebController::class, 'show'])->name("openweb.show");

Route::get('/controllo/', [ControlloController::class, 'index'])->name("controllo.index");
Route::get('/elenco', [PracticeController::class, 'index'])->name("practices.index");

Route::get('/elenco/{practice}', [PracticeController::class, 'show'])->name("practices.show");
Route::get('/elenco/{practice}/edit', [PracticeController::class, 'edit'])->name("practices.edit");
Route::put('/elenco/{practice}/edit', [PracticeController::class, 'update'])->name('practices.update');


Route::view('/griglia', 'griglia');
