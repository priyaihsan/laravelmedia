<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile-tersimpan', [ProfileController::class, 'tersimpan'])->name('profile.tersimpan');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // post
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    // untuk menghitung post like dan unlike , save dan unsave
    Route::post('/post/{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::delete('/post/{post}/unlike', [PostController::class, 'unlike'])->name('post.unlike');
    Route::post('/post/{post}/save', [PostController::class, 'save'])->name('post.save');
    Route::delete('/post/{post}/unsave', [PostController::class, 'unsave'])->name('post.unsave');

    Route::post('/user/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
    Route::delete('/user/{user}/unfollow', [UserController::class, 'unfollow'])->name('user.unfollow');
});

require __DIR__ . '/auth.php';
