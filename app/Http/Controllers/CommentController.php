<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function store(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate(
            ['body' => 'required'],
            ['body.required' => 'Поле Комментарий обязательно для заполнения']
        );

        $comment = new Comment($validated);
        $comment->author_id = auth()->id();
        $comment->article_id = $article->id;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }
}
