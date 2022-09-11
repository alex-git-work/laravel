<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Models\Article;
use App\Models\Message;
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

Route::get('/', function () {
    return view('index', ['articles' => Article::active()->get()]);
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', [MessageController::class, 'create'])->name('contacts.create');

Route::post('/contacts', [MessageController::class, 'store'])->name('contacts.store');

Route::get('/admin/feedback', function () {
    return view('feedback', ['messages' => Message::all()->sortByDesc('created_at')]);
})->name('admin.feedback');

Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');

Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

Route::post('article', [ArticleController::class, 'store'])->name('article.store');
