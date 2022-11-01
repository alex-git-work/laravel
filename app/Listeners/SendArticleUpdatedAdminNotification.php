<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Mail\ArticleUpdated as ArticleUpdatedMail;
use Illuminate\Support\Facades\Mail;

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
        Mail::to(config('mail.admin.address'))->send(new ArticleUpdatedMail($event->article));
    }
}
