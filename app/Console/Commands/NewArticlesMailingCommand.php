<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\User;
use App\Notifications\NewArticlesByPeriod;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * Class NewArticlesMailingCommand
 * @package App\Console\Commands
 */
class NewArticlesMailingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing:period {start_date : Дата в любом формате (начало периода)} {end_date : Дата в любом формате (конец периода)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Рассылает всем пользователям сообщение о новых статьях за указанный период';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $data = [
            'start_date' => $this->argument('start_date'),
            'end_date' => $this->argument('end_date'),
        ];

        $rules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            return SymfonyCommand::FAILURE;
        }

        $start = new Carbon($data['start_date']);
        $end = new Carbon($data['end_date']);

        $articles = Article::where('status', '=', Article::STATUS_PUBLISHED)->whereBetween('created_at', [
            $start->startOfDay()->translatedFormat('Y-m-d H:i:s'),
            $end->endOfDay()->translatedFormat('Y-m-d H:i:s')
        ])->get();

        User::all()->each(fn(User $u) => $u->notify(new NewArticlesByPeriod($start, $end, $articles)));

        $this->info('Команда выполнена успешно');
        return SymfonyCommand::SUCCESS;
    }
}
