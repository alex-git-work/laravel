<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsController;
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

Auth::routes();

Route::get('/', function () {
    return view('index', [
        'articles' => Article::active()->with(['tags', 'comments'])->simplePaginate(config('pagination.public_section.articles'))
    ]);
})->name('index');

Route::get('/about', fn () => view('about'))->name('about');

Route::post('/news/{news}/comment', [NewsController::class, 'comment'])->name('news.comment');
Route::resource('news', NewsController::class)->only(['index', 'show']);

Route::controller(MessageController::class)->group(function () {
    Route::get('/contacts', 'create')->name('contacts.create');
    Route::post('/contacts', 'store')->name('contacts.store');
});

Route::post('/article/{article}/comment', [ArticleController::class, 'comment'])->name('article.comment');
Route::resource('article', ArticleController::class)->except('index');

Route::get('/tag/{tag}', [TagsController::class, 'index'])->name('tag.index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::name('admin.')->group(function () {
        Route::controller(AdminArticleController::class)->group(function () {
            Route::get('/article/history/{article}', 'history')->name('article.history');
            Route::get('/article/hidden', 'hidden')->name('article.hidden');
            Route::patch('/article/{article}/toggle', 'toggle')->name('article.toggle');
        });

        Route::resource('article', AdminArticleController::class)->except('show');

        Route::resource('news', AdminNewsController::class)->except('show');

        Route::get('/feedback', function () {
            return view('admin.feedback', ['messages' => Message::orderBy('created_at', 'desc')->paginate(config('pagination.admin_section.articles'))]);
        })->name('feedback');

        Route::controller(ReportController::class)->group(function () {
            Route::get('/report', 'index')->name('report.index');
            Route::get('/report/total', 'total')->name('report.total');
            Route::post('/report', 'store')->name('report.store');
        });
    });
});
