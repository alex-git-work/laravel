<?php

namespace App\Listeners;

use App\Events\ArticleDestroyed;
use App\Mail\ArticleDestroyed as ArticleDestroyedMail;
use App\Services\PushAll;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendArticleDestroyedAdminNotification
 * @package App\Listeners
 */
class SendArticleDestroyedAdminNotification
{
    /**
     * Handle the event.
     *
     * @param ArticleDestroyed $event
     * @return void
     */
    public function handle(ArticleDestroyed $event): void
    {
        Mail::to(config('mail.admin.address'))->send(new ArticleDestroyedMail($event->article));

        if (config('pushall.enabled')) {
            $response = App::make(PushAll::class)->sendRequest('Статья удалена', $event->article->title);

            Log::debug($response);
        }
    }
}
