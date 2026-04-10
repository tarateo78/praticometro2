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