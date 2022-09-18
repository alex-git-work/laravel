<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
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
     * @return RedirectResponse
     */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        Article::create($request->validated());

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
     * @return RedirectResponse
     */
    public function update(StoreArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

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
        $article->delete();

        return redirect()->route('index')->with('success', 'Статья успешно удалена');
    }
}
