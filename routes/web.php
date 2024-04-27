<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProfileController::class, 'home']);
Route::get('tentang', [ProfileController::class, 'tentang']);
Route::get('kontak', [ProfileController::class, 'kontak']);
Route::get('form', [ProfileController::class, 'form']);

Route::post('add_form', [ProfileController::class, 'add_form']);
