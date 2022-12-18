<?php

namespace App\Jobs;

use App\Events\ReportCreated as ReportCreatedEvent;
use App\Mail\ReportCreated;
use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Log;

/**
 * Class TotalReport
 * @package App\Jobs
 */
class TotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public bool $deleteWhenMissingModels = true;

    private array $params;
    private User $user;
    private array $report = [];

    /**
     * Create a new job instance.
     *
     * @param array $params
     * @param User $user
     */
    public function __construct(array $params, User $user)
    {
        $this->params = $params;
        $this->user = $user->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        foreach ($this->params as $value) {
            $this->report[$value] = match ($value) {
                'article' => Article::where('status', '=', Article::STATUS_PUBLISHED)->count(),
                'news' => News::count(),
                'comment' => Comment::count(),
                'tag' => Tag::count(),
                'user' => User::count(),
                default => throw new Exception('Не возможно сформировать отчёт'),
            };
        }

        Mail::to($this->user->email)->queue(new ReportCreated($this->report));

        event(new ReportCreatedEvent($this->report, $this->user->id));
    }

    /**
     * @param Exception $exception
     * @return void
     */
    public function failed(Exception $exception): void
    {
        Log::error($exception->getMessage());
    }
}
