<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Contollers\BookController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('books', BooksController::class);
//creates full set of api routes instead of having to write this out
// Route::get('/books', [BooksController::class, 'index']);
// Route::post('/books', [BooksController::class, 'store']);
// Route::get('/books/{id}', [BooksController::class, 'show']);
// Route::put('/books/{id}', [BooksController::class, 'update']);
// Route::delete('/books/{id}', [BooksController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {  
    Route::apiResource('books', BooksController::class);  
});

Route::post('/login', [AuthController::class, 'login']); 

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
