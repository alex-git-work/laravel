<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

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
        $articles = $tag->articles()
            ->where('status', Article::STATUS_PUBLISHED)
            ->with('tags')
            ->with('comments')
            ->orderBy('created_at', 'desc')
            ->get();

        $news = $tag->news()
            ->with('tags')
            ->with('comments')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tag', [
            'articles' => $articles,
            'news' => $news,
        ]);
    }
}
