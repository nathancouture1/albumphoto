<?php

use App\Http\Controllers\FirstController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FirstController::class, 'index'])->name("index");
Route::get('/album/{id}', [FirstController::class, 'album'])->where('id', '[0-9]+')->name("album");

Route::middleware(["auth"])->group(function(){
    Route::get('/album/{id}/photos', [FirstController::class, 'formulaireurl'])->where('id', '[0-9]+')->name('formulaireurl');
    Route::post('/album/{id}/photos', [FirstController::class, 'ajouterphoto'])->where('id', '[0-9]+')->name('ajouterphoto');
});

Route::get('/album/{id}/upload', [FirstController::class, 'formulaireupload'])->where('id', '[0-9]+')->name('formulaireupload');
Route::post('/album/{id}/upload', [FirstController::class, 'uploadphoto'])->where('id', '[0-9]+')->name('uploadphoto');

Route::post('/album/{id}',[FirstController::class, 'supprimerphoto'])->where('id', '[0-9]+')->name('supprimerphoto');