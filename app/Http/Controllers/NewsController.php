<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $news = News::orderBy('created_at', 'desc')
            ->with(['tags', 'comments'])
            ->simplePaginate(config('pagination.public_section.news'));

        return view('news.index', [
            'news' => $news
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return View
     */
    public function show(News $news): View
    {
        $comments = $news->comments()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('news.view', [
            'news' => $news,
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param Request $request
     * @param News $news
     * @return RedirectResponse
     */
    public function comment(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate(
            ['body' => ['required', 'string']],
            ['body.required' => 'Поле Комментарий обязательно для заполнения']
        );

        $comment = new Comment($validated);
        $comment->author_id = auth()->id();
        $comment->commentable()->associate($news);
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }
}
