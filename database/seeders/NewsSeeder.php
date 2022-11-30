<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        News::factory(30)->create();

        News::all()->each(function (News $n) {
            User::all()->each(function () use ($n) {
                Comment::factory(rand(0, 1))->create([
                    'commentable_id' => $n->id,
                    'commentable_type' => News::MORPH_TYPE,
                    'created_at' => fake()->dateTimeThisYear($n->created_at),
                ]);
            });
        });
    }
}
