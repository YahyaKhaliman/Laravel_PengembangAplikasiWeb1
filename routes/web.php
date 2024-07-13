<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProfileController::class, 'form_login']);
Route::get('tentang', [ProfileController::class, 'tentang']);
Route::get('kontak', [ProfileController::class, 'kontak']);
Route::get('form', [ProfileController::class, 'form']);

Route::post('add_form', [ProfileController::class, 'add_form']);

Route::get('register', [ProfileController::class, 'register']);
Route::post('save_register', [ProfileController::class, 'save_register']);

Route::post('action_login', [ProfileController::class, 'action_login']);
Route::get('dashboard', [ProfileController::class, 'dashboard']);

Route::get('view_data', [ProfileController::class, 'data']);
Route::get('view_page_data', [ProfileController::class, 'page_data']);
Route::delete('hapus_data/{data}', [ProfileController::class, 'hapus']);

Route::get('form_update/{user_id}', [ProfileController::class, 'form_update'])->name('form_update');
Route::put('save_update', [ProfileController::class, 'save_update']);

Route::post('/logout', [ProfileController::class, 'logout']);
