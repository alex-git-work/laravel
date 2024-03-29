<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $articles = Cache::tags(Article::CACHE_TAGS)->remember('admin.article.index.page.' . request('page', 1), config('cache.redis.ttl'), function () {
            return Article::where('status', Article::STATUS_PUBLISHED)->with('history')->paginate(config('pagination.admin_section.articles'));
        });

        return view('admin.article.index', [
            'articles' => $articles,
            'is_active' => true,
        ]);
    }

    /**
     * Display a listing of the resource hidden part.
     *
     * @return View
     */
    public function hidden(): View
    {
        $articles = Cache::tags(Article::CACHE_TAGS)->remember('admin.article.hidden.page.' . request('page', 1), config('cache.redis.ttl'), function () {
            return Article::where('status', Article::STATUS_HIDDEN)->paginate(config('pagination.admin_section.articles'));
        });

        return view('admin.article.hidden', [
            'articles' => $articles,
            'is_active' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @param TagsSynchronizer $synchronizer
     * @return RedirectResponse
     */
    public function store(StoreArticleRequest $request, TagsSynchronizer $synchronizer): RedirectResponse
    {
        $article = new Article($request->validated());
        $article->author_id = auth()->id();
        $article->save();
        $synchronizer->sync($request->getTags(), $article);

        return redirect()->route('admin.article.index')->with('success', 'Статья успешно добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return view('admin.article.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreArticleRequest $request
     * @param Article $article
     * @param TagsSynchronizer $synchronizer
     * @return RedirectResponse
     */
    public function update(StoreArticleRequest $request, Article $article, TagsSynchronizer $synchronizer): RedirectResponse
    {
        $article->update($request->validated());
        $synchronizer->sync($request->getTags(), $article);

        return redirect()->route('admin.article.edit', ['article' => $article])->with('success', 'Статья успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.article.index')->with('success', 'Статья успешно удалена');
    }

    /**
     * @param Article $article
     * @return View
     */
    public function history(Article $article): View
    {
        return view('admin.article.history', [
            'article' => $article,
        ]);
    }

    /**
     * Update article status.
     *
     * @param Article $article
     * @param Request $request
     * @return RedirectResponse
     */
    public function toggle(Article $article, Request $request): RedirectResponse
    {
        if ($request->has('status')) {
            $article->update(['status' => $request->get('status')]);
        }

        return redirect()->back();
    }
}
