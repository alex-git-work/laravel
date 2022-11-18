<?php

namespace App\Listeners;

use App\Events\ArticleDestroyed;
use App\Mail\ArticleDestroyed as ArticleDestroyedMail;
use App\Services\PushAll;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendArticleDestroyedAdminNotification
 * @package App\Listeners
 */
class SendArticleDestroyedAdminNotification
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
     * @param ArticleDestroyed $event
     * @return void
     * @throws GuzzleException
     */
    public function handle(ArticleDestroyed $event): void
    {
        Mail::to(config('mail.admin.address'))->send(new ArticleDestroyedMail($event->article));

        if (config('pushall.enabled')) {
            $response = $this->notifier->sendRequest('Статья удалена', $event->article->title);

            Log::debug($response);
        }
    }
}
