<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.index', [
            'articles' => Article::all(),
            'news' => News::all(),
        ]);
    }
}
