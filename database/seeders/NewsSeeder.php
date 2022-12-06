<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
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
        News::factory(25)->create()->each(function (News $n) {
            $n->tags()->attach(
                Tag::all()
                    ->random(rand(4, 7))
                    ->pluck('id')
                    ->toArray()
            );
        });

        News::all()->each(function (News $n) {
            User::all()->each(function (User $u) use ($n) {
                $n->comments()->saveMany(Comment::factory(rand(0, 1))->create([
                    'author_id' => $u->id,
                    'commentable_id' => $n->id,
                    'commentable_type' => News::MORPH_TYPE,
                ]));
            });
        });
    }
}
