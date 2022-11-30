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
        return [
            'commentable_id' => rand(0, 1) ? Article::factory() : News::factory(),
            'commentable_type' => rand(0, 1) ? Article::MORPH_TYPE : News::MORPH_TYPE,
            'author_id' => User::factory(),
            'body' => fake()->paragraph(rand(2, 3), false),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
