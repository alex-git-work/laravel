<?php

namespace App\Events;

use App\Models\Article;
use App\Models\ArticleHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ArticleUpdated
 * @package App\Events
 */
class ArticleUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public Article $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'article.updated';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        /** @var ArticleHistory $history */
        $history = $this->article->history->last();

        return [
            'title' => $this->article->title,
            'link' => route('article.show', ['slug' => $this->article->slug]),
            'old' => $history->old,
            'current' => $history->current,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PrivateChannel|array
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        return new PrivateChannel('admin.article');
    }
}
