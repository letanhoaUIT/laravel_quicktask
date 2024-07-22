<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Đăng nhập bằng ID người dùng với ID = 2
Auth::loginUsingId(2);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');


Route::resource('/tasks', TaskController::class); //cach nhanh so voi cac lenh tren

Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware([
        'admin',
    ]);
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');


Route::resource('/tasks', TaskController::class); //cach nhanh so voi cac lenh tren
