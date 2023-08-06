<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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
