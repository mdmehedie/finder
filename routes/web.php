<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TextFindsController;
use \App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/send-data', [TextFindsController::class,'submitText'])->name('submit.text');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::put('/posts/update/{post}', [PostController::class, 'update'])->name('post.update')->middleware('can:update,post');
Route::get('/posts/delete/{post}', [PostController::class, 'destroy'])->name('post.delete')->middleware('can:delete,post');
Route::get('/admin-approve', function (){
    return view('admin-approve');
});
Route::group(['middleware' => ['approved']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.user.edit');
    Route::put('/dashboard/user/update/{id}', [DashboardController::class, 'update'])->name('dashboard.user.update');
    Route::put('/dashboard/user/delete/{id}', [DashboardController::class, 'destroy'])->name('dashboard.user.delete');
});
