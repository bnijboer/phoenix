<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
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

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::resource('posts', PostController::class);

Route::resource('posts.comments', PostCommentController::class)->only(['store', 'destroy']);

Route::get('/tags/{tag}', TagController::class)->name('tags.show');

Route::get('/search', SearchController::class)->name('search');

require __DIR__.'/auth.php';
