<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login')->name('home');

Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {
    Route::get('/profile/{username}', 'index')->name('profile.index');
    Route::patch('/profile/{username}', 'update')->name('profile.update');
    // TODO: Implement deleting of profile and account upon a "are you sure" modal
    // Route::delete('/p/{post}', 'destroy')->name('post.destroy');
});

Route::controller(PostsController::class)->middleware(['auth'])->group(function () {
    Route::get('/feed', 'index')->name('feed');
    Route::get('/p/create', 'create')->name('post.create');
    Route::post('/p', 'store')->name('post.store');
    Route::delete('/p/{post}', 'destroy')->name('post.destroy');
    Route::get('/p/{post}', 'show')->name('post.show');
});

Route::resource('comments', CommentController::class);

Route::controller(LikeController::class)->middleware(['auth'])->group(function () {
    Route::post('/like', 'like')->name('like');
    Route::delete('/like', 'unlike')->name('unlike');
});

require __DIR__ . '/auth.php';
