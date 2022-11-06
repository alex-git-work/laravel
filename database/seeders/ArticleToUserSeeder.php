<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleToUserSeeder extends Seeder
{
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
    }
}
