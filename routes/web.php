<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Đăng nhập bằng ID người dùng với ID = 2
Auth::loginUsingId(2);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/user/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::put('/user/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/user', [UserController::class, 'store'])->name('users.store');
});

Route::resource('task', TaskController::class);

Route::get('locale/{lang}', [LanguageController::class, 'setLocale'])->name('locale');


require __DIR__.'/auth.php';
