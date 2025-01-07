<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pets;

Route::resource('/pets', Pets::class);
