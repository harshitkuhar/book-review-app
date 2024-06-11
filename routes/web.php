<?php

use App\Http\Middleware\validUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;


Route::get('/', [HomeController::class, 'allBooks'])->name('home.books');
Route::get('book-detail/{id}', [HomeController::class, 'bookDetailPage'])->name('home.singlebook');

Route::get('/account/register', [UserController::class, 'showRegister'])->name('account.register');
Route::POST('/account/save-register', [UserController::class, 'saveRegister'])->name('account.saveRegister');
Route::get('/account/login', [UserController::class, 'showLogin'])->name('account.login');
Route::POST('/account/save-login', [UserController::class, 'saveLogin'])->name('account.saveLogin');
Route::get('/account/profile', [UserController::class, 'showProfile'])->name('account.profile')->middleware([validUser::class]);
Route::get('/account/logout', [UserController::class, 'logout'])->name('account.logout');
Route::POST('/account/update-profile', [UserController::class, 'updateProfile'])->name('account.updateProfile');

Route::resource('book', BookController::class);
Route::resource('review', ReviewController::class)->middleware([validUser::class]);
Route::get('my-reviews/{user_id}', [ReviewController::class, 'show'])->name('review.my')->middleware([validUser::class]);;
Route::get('my-review/{id}', [ReviewController::class, 'showEdit'])->name('review.myedit')->middleware([validUser::class]);;
Route::Post('update-my-review/{id}', [ReviewController::class, 'updateMyReview'])->name('updateMyReview')->middleware([validUser::class]);;

