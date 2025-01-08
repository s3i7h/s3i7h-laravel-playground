<?php

use App\Http\Controllers\BookStocks;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Books;

Route::group(['prefix' => ''], function () {
    Route::get('/books', [Books::class, 'list_books']);
    Route::post('/books', [Books::class, 'create_book']);
    Route::get('/books/{id}', [Books::class, 'get_book']);
    Route::get('/book-stocks', [BookStocks::class, 'list_book_stocks']);
    Route::get('/books/{book_id}/stocks', [BookStocks::class, 'get_book_stocks']);
    Route::post('/books/{book_id}/stocks', [BookStocks::class, 'create_book_stock']);
    Route::get('/books/{book_id}/stocks/{book_stock_id}', [BookStocks::class, 'get_book_stock']);
});
