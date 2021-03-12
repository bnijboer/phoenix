<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
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

Route::get('/', [PagesController::class, 'landing'])->name('landing');
Route::get('/about', [PagesController::class, 'about'])->name('about');

Route::post('/posts/{post}/tags', [PostTagController::class, 'store'])->name('posts.tags.store');
Route::resource('posts', PostController::class);

require __DIR__.'/auth.php';
