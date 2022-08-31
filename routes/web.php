<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
Route::get('/posts/{post:id}/edit', [PostController::class, 'edit'])->middleware('auth')->name('posts.edit');
Route::post('/posts/{post:id}', [PostController::class, 'update'])->middleware('auth')->name('posts.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
