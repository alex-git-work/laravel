<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\View\View;
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
        $news = News::orderBy('created_at', 'desc')->simplePaginate(config('pagination.public_section.news'));

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
        return view('news.view', [
            'news' => $news,
        ]);
    }
}
