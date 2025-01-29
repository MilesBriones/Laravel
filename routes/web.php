<?php

use App\Http\Controllers\cart;
use App\Http\Controllers\shop;
use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

// Public Route
Route::get('/', function () {
    return view('welcome');
});
// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Admin Routes - Protected by auth middleware
Route::middleware('auth')->prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('delete/{movie}', [AdminController::class, 'delete'])->name('admin.delete');

});
// Shop Routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');

use App\Http\Controllers\RegisterController;

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

