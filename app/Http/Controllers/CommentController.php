<?php

namespace App\Http\Controllers;

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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'commentable_type' => ['required', 'string'],
                'commentable_id' => ['required', 'integer'],
                'body' => ['required', 'string'],
            ],
            ['body.required' => 'Поле Комментарий обязательно для заполнения']
        );

        $comment = new Comment($validated);
        $comment->author_id = auth()->id();
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий успешно добавлен');
    }
}
