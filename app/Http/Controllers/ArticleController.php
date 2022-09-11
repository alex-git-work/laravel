<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'status' => [Rule::in(Article::STATUSES)],
            'preview' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:' . Article::class . ',slug', 'regex:/^[a-z0-9]+(?:[_-][a-z0-9]+)*$/'],
        ];

        $messages = [
            'title.required' => 'Поле Название страницы обязательно для заполнения',
            'title.string' => 'Поле должно быть строкой',
            'title.between' => 'Поле Название страницы должно быть не менее 5 и не более 100 символов',
            'status.in' => 'Недопустимое значение статуса',
            'preview.required' => 'Поле Краткое описание статьи обязательно для заполнения',
            'preview.string' => 'Поле должно быть строкой',
            'preview.max' => 'Длина описания не должна превышать 255 символов',
            'body.required' => 'Поле Основной текст обязательно для заполнения',
            'body.string' => 'Поле должно быть строкой',
            'slug.string' => 'Поле должно быть строкой',
            'slug.unique' => 'Такой slug уже занят',
            'slug.regex' => 'Введенное значение не соответствует условиям',
        ];

        $validated = $request->validate([
            'title' => ['required', 'string', 'between:5,100']
        ], $messages);

        if ($request->get('slug') === null) {
            $request->merge(['slug' => Str::slug($validated['title'])]);
            $rules['slug'] = ['unique:' . Article::class . ',slug'];
        }

        $validated = array_merge($validated, $request->validate($rules, $messages));

        Article::create($validated);

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
}
