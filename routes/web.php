<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');
Route::resource('/products', ProductsController::class);
