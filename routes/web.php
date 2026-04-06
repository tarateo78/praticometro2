<?php

use App\Http\Controllers\PostController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/api/tasks', function () {
    return Task::all();
});

Route::resource('posts', PostController::class);
