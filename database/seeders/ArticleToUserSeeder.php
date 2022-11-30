<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleToUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Tag::factory(12)->create();

        User::all()->where('role_id', '!=', Role::ADMIN)->each(function (User $u) {
            Article::factory(rand(5, 10))->create(['author_id' => $u->id])->each(function (Article $a) {
                $a->tags()->attach(
                    Tag::all()
                        ->random(rand(4, 8))
                        ->pluck('id')
                        ->toArray()
                );
            });
        });

        Article::all()->each(function (Article $a) {
            User::all()->each(function (User $u) use ($a) {
                Comment::factory(rand(0, 1))->create([
                    'commentable_id' => $a->id,
                    'commentable_type' => Article::MORPH_TYPE,
                    'author_id' => $u->id,
                    'created_at' => fake()->dateTimeThisYear($a->created_at),
                ]);
            });
        });
    }
}
