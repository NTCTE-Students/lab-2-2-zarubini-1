<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index']) -> name('index');

Route::get('/register', function() {
    return view('auth.register');
}) -> name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', function() {
    return view('auth.login');
}) -> name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/logout', [UserController::class, 'logout'])
    -> name('logout')
    -> middleware('auth');

Route::get('/tasks/{task?}', [TaskController::class, 'index'])
    -> name('tasks.index')
    -> middleware('auth');
Route::post('/tasks/{task?}', [TaskController::class, 'createOrUpdate'])
    -> middleware('auth');

Route::get('/tasks/delete/{task}', [TaskController::class, 'delete'])
    -> name('tasks.delete')
    -> middleware('auth');
