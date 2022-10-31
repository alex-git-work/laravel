<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleUpdated extends Notification
{
    use Queueable;

    public Article $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Обновление статьи')
            ->greeting('Привет!')
            ->line($this->article->updated_at->translatedFormat('j F Y') . ' была обновлена статья')
            ->line($this->article->title)
            ->action('Посмотреть', route('article.show', ['article' => $this->article]))
            ->salutation('Рассылка от ' . config('app.name'));
    }
}
