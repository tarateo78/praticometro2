<?php

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\OpenwebController;
use App\Http\Controllers\ControlloController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;



Route::get('/api/tasks', function () {
    #return Task::all();
});

Route::get('/', [OpenwebController::class, 'index'])->name("openweb.index");
Route::get('/show/{practice}', [OpenwebController::class, 'show'])->name("openweb.show");

Route::get('/controllo', [ControlloController::class, 'index'])->name("controllo.index");
Route::get('/controllo/nuove-pratiche', [ControlloController::class, 'nuovePratiche'])->name("controllo.nuove-pratiche");
Route::get('/elenco', [PracticeController::class, 'index'])->name("practices.index");

Route::get('/elenco/{practice}', [PracticeController::class, 'show'])->name("practices.show");
Route::get('/elenco/{practice}/edit', [PracticeController::class, 'edit'])->name("practices.edit");
Route::put('/elenco/{practice}/edit', [PracticeController::class, 'update'])->name('practices.update');

Route::get('/report', [ReportController::class, 'index'])->name('report.index');

Route::view('/griglia', 'griglia');

/* TEST */

Route::get('/test', [TestController::class, 'index'])->name('test.index');
Route::post('/test/store', [TestController::class, 'store'])->name('test.store');

Route::get('/test/{test}', [TestController::class, 'show'])->name('test.show');
Route::put('/test/{test}', [TestController::class, 'update'])->name('test.update');