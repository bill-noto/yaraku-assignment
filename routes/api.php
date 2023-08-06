<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
 * Routes for books resource
 */

Route::get('/', [BooksController::class, 'index'])->name('books');
Route::get('/books/create', [BooksController::class, 'create'])->name('booksCreate');
Route::post('/books', [BooksController::class, 'store']);
Route::delete('/books/{id}', [BooksController::class, 'destroy']);
Route::get('/books/{id}', [BooksController::class, 'show']);
Route::get('/books/edit/{id}', [BooksController::class, 'edit']);
Route::patch('/books/{id}', [BooksController::class, 'update']);
