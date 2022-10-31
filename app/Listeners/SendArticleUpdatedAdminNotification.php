<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Models\Admin;
use App\Notifications\ArticleUpdated as ArticleUpdatedNotification;
use Illuminate\Support\Facades\Notification;

/**
 * Class SendArticleUpdatedAdminNotification
 * @package App\Listeners
 */
class SendArticleUpdatedAdminNotification
{
    /**
     * Handle the event.
     *
     * @param ArticleUpdated $event
     * @return void
     */
    public function handle(ArticleUpdated $event): void
    {
        Notification::send(new Admin(), new ArticleUpdatedNotification($event->article));
    }
}
