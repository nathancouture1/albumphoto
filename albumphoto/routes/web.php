<?php

use App\Http\Controllers\FirstController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FirstController::class, 'index'])->name("index");
Route::get('/album/{id}', [FirstController::class, 'album'])->where('id', '[0-9]+')->name("album");
Route::post('/album/{id}/photos', [FirstController::class, 'ajouterphoto'])->where('id', '[0-9]+')->name('ajouterphoto');
Route::post('/album/{id}/upload', [FirstController::class, 'uploadphoto'])->where('id', '[0-9]+')->name('uploadphoto');