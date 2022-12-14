<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Services\TagsSynchronizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('can:update,article')->only(['edit', 'update', 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('articles.create');
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

        return redirect()->back()->with('success', 'Статья успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $article = Cache::tags(Article::CACHE_TAGS)
            ->remember('article.view.' . $slug, config('cache.redis.ttl'), fn () => Article::where('slug', $slug)->with('comments')->with('tags')->firstOrFail());

        $comments = $article->comments()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('articles.view', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return view('articles.edit', [
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

        return redirect()->route('article.edit', ['article' => $article])->with('success', 'Статья успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->history()->delete();
        $article->delete();

        return redirect()->route('index')->with('success', 'Статья успешно удалена');
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function comment(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate(
            ['body' => ['required', 'string']],
            ['body.required' => 'Поле Комментарий обязательно для заполнения']
        );

        $comment = new Comment($validated);
        $comment->author_id = auth()->id();
        $comment->commentable()->associate($article);
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }
}
