<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Mail\ArticleUpdated as ArticleUpdatedMail;
use App\Services\PushAll;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendArticleUpdatedAdminNotification
 * @package App\Listeners
 */
class SendArticleUpdatedAdminNotification
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
     * @param ArticleUpdated $event
     * @return void
     * @throws GuzzleException
     */
    public function handle(ArticleUpdated $event): void
    {
        Mail::to(config('mail.admin.address'))->send(new ArticleUpdatedMail($event->article));

        if (config('pushall.enabled')) {
            $response = $this->notifier->sendRequest('Статья обновлена', $event->article->title);

            Log::debug($response);
        }
    }
}
