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

// Navbar pages routes
Route::get('/',         [PageController::class, 'home'])->name('home');
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/admin',    [PageController::class, 'admin'])->name('admin');

// Blog post routes
Route::resource('posts', PostController::class);

// Comment section routes
Route::resource('posts.comments', PostCommentController::class)->only(['store', 'destroy']);

// Tag routes
Route::get('/tags/{tag}', TagController::class)->name('tags.show');

// Search bar routes
Route::get('/search', SearchController::class)->name('search');

require __DIR__.'/auth.php';
