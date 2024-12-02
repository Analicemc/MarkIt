<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// USERS
Route::post('/api/users', [UserController::class, 'store']);

// ITEM
Route::post('/api/items', [ItemController::class, 'store']);