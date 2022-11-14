<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Mail\ArticleCreated as ArticleCreatedMail;
use App\Services\PushAll;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendArticleCreatedAdminNotification
 * @package App\Listeners
 */
class SendArticleCreatedAdminNotification
{
    /**
     * Handle the event.
     *
     * @param ArticleCreated $event
     * @return void
     */
    public function handle(ArticleCreated $event): void
    {
        Mail::to(config('mail.admin.address'))->send(new ArticleCreatedMail($event->article));

        if (config('pushall.enabled')) {
            $response = App::make(PushAll::class)
                ->sendRequest('Создана новая статья', $event->article->title . ' by ' . $event->article->user->name);
            Log::debug($response);
        }
    }
}
