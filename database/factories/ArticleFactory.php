<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = ucfirst(fake()->words(rand(2, 5), true));
        $body = '';

        for ($i = 0; $i < rand(1, 5); $i++) {
            $body .= fake()->text(rand(800, 1500)) . "\r\n\r\n";
        }

        return [
            'author_id' => 1,
            'status' => Article::STATUS_PUBLISHED,
            'title' => $title,
            'preview' => fake()->paragraph(rand(1, 3), false),
            'body' => $body,
            'slug' => Str::slug($title),
        ];
    }
}
