<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Mail\ArticleCreated as ArticleCreatedMail;
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
    }
}
