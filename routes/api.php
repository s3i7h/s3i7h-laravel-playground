<?php

use App\Http\Controllers\BookStocks;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Books;

Route::group(['prefix' => ''], function () {
    Route::get('/books', [Books::class, 'listBooks']);
    Route::post('/books', [Books::class, 'createBook']);
    Route::get('/books/{id}', [Books::class, 'getBook']);
    Route::get('/book-stocks', [BookStocks::class, 'listBookStocks']);
    Route::get('/books/{book_id}/stocks', [BookStocks::class, 'getBookStocks']);
    Route::post('/books/{book_id}/stocks', [BookStocks::class, 'createBookStock']);
    Route::get('/books/{book_id}/stocks/{book_stock_id}', [BookStocks::class, 'getBookStock']);
});
