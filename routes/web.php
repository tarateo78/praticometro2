<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/api/tasks', function () {
    #return Task::all();
});

Route::resource('posts', PostController::class);

Route::get('/elenco', [PracticeController::class, 'index'])->name("practices.index");

Route::get('/elenco/{practice}', [PracticeController::class, 'show'])->name("practices.show");
Route::get('/elenco/{practice}/edit', [PracticeController::class, 'edit'])->name("practices.edit");
Route::put('/elenco/{practice}/edit', [PracticeController::class, 'update'])->name('practices.update');
