<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $condition = rand(0, 1);

        return [
            'commentable_id' => $condition ? Article::factory() : News::factory(),
            'commentable_type' => $condition ? Article::MORPH_TYPE : News::MORPH_TYPE,
            'author_id' => User::factory(),
            'body' => fake()->paragraph(rand(2, 3), false),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
