<?php

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

Route::redirect('/', '/login');

Route::controller(PostsController::class)->middleware(['auth'])->group(function () {
    Route::get('/feed', 'index')->name('feed');
    Route::get('/p/create', 'create')->name('post.create');
    Route::post('/p', 'store')->name('post.store');
    Route::delete('/p/{post}', 'destroy')->name('post.destroy');
});

Route::controller(LikeController::class)->middleware(['auth'])->group(function () {
    Route::post('/like', 'like')->name('like');
    Route::delete('/like', 'unlike')->name('unlike');
});

require __DIR__ . '/auth.php';
