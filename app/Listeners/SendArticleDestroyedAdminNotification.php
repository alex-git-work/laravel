<?php

namespace App\Listeners;

use App\Events\ArticleDestroyed;
use App\Models\Admin;
use App\Notifications\ArticleDestroyed as ArticleDestroyedNotification;
use Illuminate\Support\Facades\Notification;

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
        Notification::send(new Admin(), new ArticleDestroyedNotification($event->article));
    }
}
