<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProfileController::class, 'index'])->name('home');

Route::get('/item/{product_id}', [ItemController::class, 'getDetail'])->name('product.show');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create'])->name('register');

Route::get('/login', [LoginController::class, 'create'])
    ->middleware(['guest'])
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware(['guest'])
    ->name('login.post');

Route::middleware('auth')->group(function () {

    Route::get('/mypage', [ProfileController::class, 'mypage'])->name('mypage');

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/mypage/profile', [ProfileController::class, 'update']);

    Route::get('/sell', [ItemController::class, 'listing']);

    Route::post('/sell', [ItemController::class, 'store'])->name('product.store');

    Route::get('/purchase/{product_id}', [ItemController::class, 'purchase'])->name('purchase.show');

    Route::get('/purchase/address/{product_id}', [ItemController::class, 'address']);

    Route::post('/purchase/{product_id}', [ItemController::class, 'editAddress'])->name('edit.address');

    Route::post('/checkout', [ItemController::class, 'createCheckoutSession'])->name('product.purchase');

    Route::get('/search', [ItemController::class, 'search']);

    Route::post('/comment', [CommentController::class, 'comment'])->name('comment.store');

    Route::post('/product/{id}/like', [LikeController::class, 'toggleLike'])->name('product.toggleLike');
});