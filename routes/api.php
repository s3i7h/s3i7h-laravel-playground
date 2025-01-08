<?php

use App\Http\Controllers\BookStocks;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Books;

Route::group(['prefix' => ''], function () {
    Route::get('/books', [Books::class, 'index']);
    Route::post('/books', [Books::class, 'store']);
    Route::get('/books/{id}', [Books::class, 'show']);
    Route::get('/book-stocks', [BookStocks::class, 'index']);
    Route::post('/book-stocks', [BookStocks::class, 'store']);
    Route::get('/book-stocks/{id}', [BookStocks::class, 'show']);
});
