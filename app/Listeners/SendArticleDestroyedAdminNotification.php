<?php

namespace App\Listeners;

use App\Events\ArticleDestroyed;
use App\Mail\ArticleDestroyed as ArticleDestroyedMail;
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
    }
}
