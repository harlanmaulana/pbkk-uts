<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users1Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\BookAuthorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
     Route::post('/logout', [AuthController::class, 'logout']);

    // API Resource Routes
    Route::apiResource('users1', Users1Controller::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('authors', AuthorsController::class);
    Route::apiResource('books', BooksController::class);
    Route::apiResource('loans', LoansController::class);

    // BookAuthors (pivot table) routes
    Route::get('/bookauthors', [BookAuthorsController::class, 'index']);
    Route::post('/bookauthors', [BookAuthorsController::class, 'store']);
    Route::delete('/bookauthors', [BookAuthorsController::class, 'destroy']);
});
 