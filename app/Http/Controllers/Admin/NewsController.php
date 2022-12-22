<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreNewsRequest;
use App\Models\News;
use App\Services\TagsSynchronizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class NewsController
 * @package App\Http\Controllers\Admin
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
        $news = Cache::tags(News::CACHE_TAGS)->remember('admin.news.index.page.' . request('page', 1), config('cache.redis.ttl'), function () {
            return News::paginate(config('pagination.admin_section.news'));
        });

        return view('admin.news.index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @param TagsSynchronizer $synchronizer
     * @return RedirectResponse
     */
    public function store(StoreNewsRequest $request, TagsSynchronizer $synchronizer): RedirectResponse
    {
        $news = new News($request->validated());
        $news->save();
        $synchronizer->sync($request->getTags(), $news);

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return View
     */
    public function edit(News $news): View
    {
        return view('admin.news.edit', [
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNewsRequest $request
     * @param News $news
     * @param TagsSynchronizer $synchronizer
     * @return RedirectResponse
     */
    public function update(StoreNewsRequest $request, News $news, TagsSynchronizer $synchronizer): RedirectResponse
    {
        $news->update($request->validated());
        $synchronizer->sync($request->getTags(), $news);

        return redirect()->route('admin.news.edit', ['news' => $news])->with('success', 'Новость успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно удалена');
    }
}
