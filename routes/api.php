<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', action: [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('books', action: [BookController::class, 'index']);
Route::post('/add-book', [BookController::class, 'addBook']);

Route::middleware('cors')->post('/add-book', [BookController::class, 'store']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'edit']);  // Get user details for editing
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);  // Delete user
// Route::get('/users', [UserController::class, 'getUsers']);

// Route::get('/users', function () {
//     return User::all();
// });

// Route::get('/users', [UserController::class, 'getAllUsers']);