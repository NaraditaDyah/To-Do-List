<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Halaman All Tasks (Utama)
Route::get('/', [TodoController::class, 'index'])->name('todo.index');

// HALAMAN BARU: Today's Task
Route::get('/today', [TodoController::class, 'today'])->name('todo.today');

// Rute Proses Data
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{id}/check', [TodoController::class, 'check'])->name('todo.check');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');