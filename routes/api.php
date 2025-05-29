<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users1Controller;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\BookAuthorsController;

// Public Route
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires Sanctum Authentication)
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // API Resource Routes
    Route::apiResource('users', Users1Controller::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('authors', AuthorsController::class);
    Route::apiResource('books', BooksController::class);
    Route::apiResource('loans', LoansController::class);
    Route::apiResource('bookauthors', BookAuthorsController::class);

});
