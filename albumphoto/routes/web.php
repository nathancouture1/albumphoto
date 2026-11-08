<?php

use App\Http\Controllers\FirstController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FirstController::class, 'index'])->name("index");
Route::get('/album/{id}', [FirstController::class, 'album'])->where('id', '[0-9]+')->name("album");

