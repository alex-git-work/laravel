<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    protected const CACHE_TTL = 1 * 10 * 60;
    protected const CACHE_KEY_STAT = 'stat';

    /**
     * @return View
     */
    public function index(): View
    {
        $data = Cache::get(self::CACHE_KEY_STAT);

        if ($data === null) {

            $data['articlesQty'] = Article::selectRaw(
                'COUNT(*) as total,
                SUM(status = ' . Article::STATUS_PUBLISHED . ') as published,
                SUM(status = ' . Article::STATUS_HIDDEN . ') as hidden'
            )->first()->toArray();

            $data['maxArticleLength'] = Article::selectRaw('*, LENGTH(body) as length')
                ->where('status', '=', Article::STATUS_PUBLISHED)
                ->orderBy('length', 'desc')
                ->first();

            $data['mimArticleLength'] = Article::selectRaw('*, LENGTH(body) as length')
                ->where('status', '=', Article::STATUS_PUBLISHED)
                ->orderBy('length')
                ->first();

            $data['historyMax'] = Article::where('status', '=', Article::STATUS_PUBLISHED)
                ->withCount('history')
                ->orderBy('history_count', 'desc')
                ->first();

            $data['commentsMax'] = Article::where('status', '=', Article::STATUS_PUBLISHED)
                ->withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->first();

            $data['maxArticlesUser'] = User::withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->first();

            $data['articlesAvg'] = User::withCount('articles')
                ->having('articles_count', '>', 1)
                ->get()
                ->avg('articles_count');

            $data['news'] = News::count();

            Cache::put(self::CACHE_KEY_STAT, $data, self::CACHE_TTL);
        }

        return view('admin.index', [
            'articlesQty' => $data['articlesQty'],
            'maxArticleLength' => $data['maxArticleLength'],
            'mimArticleLength' => $data['mimArticleLength'],
            'historyMax' => $data['historyMax'],
            'commentsMax' => $data['commentsMax'],
            'maxArticlesUser' => $data['maxArticlesUser'],
            'articlesAvg' => $data['articlesAvg'],
            'news' => $data['news'],
        ]);
    }
}
