<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show')->middleware('can:view,post');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/update/{post}', [PostController::class, 'update'])->name('post.update')->middleware('can:update,post');
Route::get('/posts/delete/{post}', [PostController::class, 'destroy'])->name('post.delete')->middleware('can:delete,post');