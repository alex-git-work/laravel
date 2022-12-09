<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Class ReportCreated
 * @package App\Mail
 */
class ReportCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $report;

    public const REPORTABLE = [
        'article' => 'Статей',
        'news' => 'Новостей',
        'comment' => 'Комментариев',
        'tag' => 'Тегов',
        'user' => 'Пользователей',
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $report)
    {
        $this->report = $report;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Запрошенный отчет от ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.report-created',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
