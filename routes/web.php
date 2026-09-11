<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');

// Delete route
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');