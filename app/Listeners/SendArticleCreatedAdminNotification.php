<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Mail\ArticleCreated as ArticleCreatedMail;
use App\Services\PushAll;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendArticleCreatedAdminNotification
 * @package App\Listeners
 */
class SendArticleCreatedAdminNotification
{
    protected PushAll $notifier;

    /**
     * @param PushAll $notifier
     */
    public function __construct(PushAll $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * Handle the event.
     *
     * @param ArticleCreated $event
     * @return void
     * @throws GuzzleException
     */
    public function handle(ArticleCreated $event): void
    {
        Mail::to(config('mail.admin.address'))->send(new ArticleCreatedMail($event->article));

        if (config('pushall.enabled')) {
            $response = $this->notifier->sendRequest('Создана новая статья', $event->article->title . ' by ' . $event->article->user->name);

            Log::debug($response);
        }
    }
}
