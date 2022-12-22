<?php

namespace App\Http\Controllers\Admin;

use App\Services\Stat;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $data = Cache::tags(Stat::CACHE_TAGS)->remember(Stat::CACHE_KEY_STAT, Stat::CACHE_TTL, fn () => Stat::getData());

        return view('admin.index', [
            'articlesQty' => $data['articlesQty'],
            'maxArticleLength' => $data['maxArticleLength'],
            'minArticleLength' => $data['minArticleLength'],
            'historyMax' => $data['historyMax'],
            'commentsMax' => $data['commentsMax'],
            'maxArticlesUser' => $data['maxArticlesUser'],
            'articlesAvg' => $data['articlesAvg'],
            'news' => $data['news'],
        ]);
    }
}
