<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;




Route::get('/', function () {
    return view('home'); 
});
Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');

Route::post('register', [RegisterController::class, 'register']);
Route::middleware('api')->post('register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::get('/admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminAuthController::class, 'login']);
Route::get('/admin-register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin-register', [AdminAuthController::class, 'register']);  // This should be POST
Route::post('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/users', [UserController::class, 'index']);  // List all users
Route::get('/users/{id}/edit', [UserController::class, 'edit']);  // Show edit form
Route::put('/users/{id}', [UserController::class, 'update']);  // Update user details
Route::delete('/users/{id}', [UserController::class, 'destroy']);  // Delete user


Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::get('/test-db', function () {
    try {
        \DB::connection()->getPdo();
        return 'Database connection is working.';
    } catch (\Exception $e) {
        return 'Database connection error: ' . $e->getMessage();
    }
});
