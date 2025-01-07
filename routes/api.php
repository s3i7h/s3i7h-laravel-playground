<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pets;

Route::get('/pets', [Pets::class, 'index']);
Route::post('/pets', [Pets::class, 'store']);
Route::get('/pets/{id}', [Pets::class, 'show']);
