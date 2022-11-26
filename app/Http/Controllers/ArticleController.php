<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

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
        $this->middleware('can:view,article')->only('show');
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
     * @param Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        return view('articles.view', [
            'article' => $article,
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
}
