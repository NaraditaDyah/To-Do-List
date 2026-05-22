<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Saat membuka localhost:8000, langsung tampilkan halaman To-Do List
Route::get('/', [TodoController::class, 'index'])->name('todo.index');

// Rute untuk memproses data To-Do List (tanpa pelindung auth)
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{id}/check', [TodoController::class, 'check'])->name('todo.check');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');