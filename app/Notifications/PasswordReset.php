<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

/**
 * Class PasswordReset
 * @package App\Notification
 */
class PasswordReset extends Notification
{
    use Queueable;

    protected string $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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
            ->subject('Смена пароля на сайте  ' . config('app.name'))
            ->greeting('Привет, ' . $notifiable->name . '!')
            ->line('Чтобы задать ваш новый пароль, пожалуйста, перейдите по ссылке ниже:')
            ->action('Сбросить пароль', route('password.reset', ['token' => $this->token]))
            ->line('Если Вы не сбрасывали пароль от своей учётной записи - пожалуйста, проигнорируйте это сообщение.')
            ->line(new HtmlString('<br><br>'))
            ->salutation('С уважением, ' . config('app.name') . '.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
