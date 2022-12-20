<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

/**
 * Class FeedbackController
 * @package App\Http\Controllers\Admin
 */
class FeedbackController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $messages = Cache::tags(Message::CACHE_TAGS)->remember('admin.feedback.page.' . request('page', 1), config('cache.redis.ttl'), function () {
            return Message::orderBy('created_at', 'desc')->paginate(config('pagination.admin_section.articles'));
        });

        return view('admin.feedback', [
            'messages' => $messages,
        ]);
    }
}
