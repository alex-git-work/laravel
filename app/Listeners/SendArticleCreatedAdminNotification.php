<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Models\Admin;
use App\Notifications\ArticleCreated as ArticleCreatedNotification;
use Illuminate\Support\Facades\Notification;

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
        Notification::send(new Admin(), new ArticleCreatedNotification($event->article));
    }
}
