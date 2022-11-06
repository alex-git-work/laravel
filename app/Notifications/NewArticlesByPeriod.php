<?php

namespace App\Notifications;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

/**
 * Class NewArticlesByPeriod
 * @package App\Notification
 */
class NewArticlesByPeriod extends Notification
{
    use Queueable;

    protected Carbon $start;
    protected Carbon $end;

    /**
     * @var Collection<Article>
     */
    protected Collection $articles;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $start, string $end)
    {
        $this->start = new Carbon($start);
        $this->end = new Carbon($end);

        $this->articles = Article::all()->whereBetween('created_at', [
            $this->start->startOfDay()->translatedFormat('Y-m-d H:i:s'),
            $this->end->endOfDay()->translatedFormat('Y-m-d H:i:s')
        ])->where('status', '=', Article::STATUS_PUBLISHED);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $period = 'с ' . $this->start->translatedFormat('j F Y') . ' по ' . $this->end->translatedFormat('j F Y');
        $message = new MailMessage();

        $message->subject('Новостная рассылка от ' . config('app.name') . ' за период ' . $period);
        $message->greeting('Привет, '. $notifiable->name . '!');

        if ($this->articles->isNotEmpty()) {
            $message->line('За прошедшую неделю были опубликованы следующие статьи:');

            foreach ($this->articles as $a) {
                $message->line(new HtmlString('<a href="' . route('article.show', ['article' => $a]) . '" target="_blank">' . $a->title . '</a>'));
            }
        } else {
            $message->line('За прошедшую неделю не было опубликовано новых статей');
            $message->action('Но вы можете освежить воспоминания и почитать старые', route('index'));
        }

        $message->line(new HtmlString('<br><br>'));
        $message->salutation('С уважением, ' . config('app.name') . '.');

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
