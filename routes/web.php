<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TagsController;
use App\Models\Article;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
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
    return view('index', ['articles' => Article::active()->with('tags')->latest()->get()]);
})->name('index');

Route::get('/about', fn () => view('about'))->name('about');

Route::get('/contacts', [MessageController::class, 'create'])->name('contacts.create');

Route::post('/contacts', [MessageController::class, 'store'])->name('contacts.store');

Route::get('/admin/feedback', function () {
    return view('feedback', ['messages' => Message::all()->sortByDesc('created_at')]);
})->name('admin.feedback');

Route::resource('article', ArticleController::class)->except('index');

Route::get('/tag/{tag}', [TagsController::class, 'index'])->name('tag.index');

Auth::routes();
