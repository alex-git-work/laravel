<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class TagsController
 * @package App\Http\Controllers
 */
class TagsController extends Controller
{
    /**
     * @param Tag $tag
     * @return View
     */
    public function index(Tag $tag): View
    {
        $articles = Cache::tags(Article::CACHE_TAGS)->remember('tag.articles.' . $tag->name, config('cache.redis.ttl'), function () use ($tag) {
            return $tag->articles()
                ->where('status', Article::STATUS_PUBLISHED)
                ->with('tags')
                ->with('comments')
                ->orderBy('created_at', 'desc')
                ->get();
        });

        $news = Cache::tags(News::CACHE_TAGS)->remember('tag.news.' . $tag->name, config('cache.redis.ttl'), function () use ($tag) {
            return $tag->news()
                ->with('tags')
                ->with('comments')
                ->orderBy('created_at', 'desc')
                ->get();
        });

        return view('tag', [
            'articles' => $articles,
            'news' => $news,
        ]);
    }
}
