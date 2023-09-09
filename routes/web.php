<?php

use App\Http\Controllers\CommisionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderDetailController;
use App\Models\Order;
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
    Route::get('/{name}/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/{name}/layanan', [ProfileController::class, 'layanan'])->name('profile.layanan');
    Route::get('/{name}/tersimpan', [ProfileController::class, 'tersimpan'])->name('profile.tersimpan');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //checkout
    Route::get('/checkout',[ProfileController::class,'checkout'])->name('profile.checkout');


    //commision
    Route::resource('commision', CommisionController::class);
    // Route::get('/commision-create', [CommisionController::class, 'create'])->name('commision.create');
    // Route::get('/commision-edit/{commision}', [CommisionController::class, 'edit'])->name('commision.edit');
    // Route::patch('/commision/{commision}', [CommisionController::class, 'update'])->name('commision.update');
    // Route::delete('/commision/{commision}', [CommisionController::class, 'destroy'])->name('commision.destroy');
    // Route::post('/commision', [CommisionController::class, 'store'])->name('commision.store');

    // order detail
    Route::post('/{id}/addToCard', [OrderDetailController::class, 'addToCard'])->name('orderDetail.addToCard');

    // order
    Route::get('/{name}/order', [OrderController::class, 'index'])->name('order.index');
    Route::patch('{name}/checkout',[OrderController::class , 'orderCheckout'])->name('order.checkout');
    // increment and decrement quantity
    Route::patch('/{id}/increment', [OrderDetailController::class, 'increment'])->name('orderDetail.increment');
    Route::patch('/{id}/decrement', [OrderDetailController::class, 'decrement'])->name('orderDetail.decrement');

    // delete order detail
    Route::delete('/{id}/delete', [OrderDetailController::class, 'destroy'])->name('orderDetail.destroy');

    // order payment
    Route::get('/order-payment', [OrderController::class, 'orderPayment'])->name('order.orderPayment');

    // post - message , notification
    Route::get('/message',[PostController::class, 'message'])->name('post.message');
    Route::get('/notification',[PostController::class, 'notification'])->name('post.notification');

    // payment
    Route::get('/{id}/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/{id}/payment-store', [PaymentController::class, 'store'])->name('payment.store');


    Route::resource('post', PostController::class);
    // Route::get('/post', [PostController::class, 'index'])->name('post.index');
    // Route::post('/post', [PostController::class, 'store'])->name('post.store');
    // Route::get('/post-create', [PostController::class, 'create'])->name('post.create');
    // Route::get('/post-edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    // Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    // Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    // untuk menghitung post like dan unlike , save dan unsave
    Route::post('/post-like/{post}', [PostController::class, 'like'])->name('post.like');
    Route::delete('/post-unlike/{post}', [PostController::class, 'unlike'])->name('post.unlike');
    Route::post('/post-save/{post}', [PostController::class, 'save'])->name('post.save');
    Route::delete('/post-unsave/{post}', [PostController::class, 'unsave'])->name('post.unsave');

    Route::post('/user-follow/{user}', [FollowController::class, 'follow'])->name('user.follow');
    Route::delete('/user-unfollow/{user}', [FollowController::class, 'unfollow'])->name('user.unfollow');
});

require __DIR__ . '/auth.php';
