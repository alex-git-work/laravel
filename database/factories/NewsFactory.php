<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(rand(5, 7), true)),
            'body' => fake()->paragraphs(rand(3, 6), true),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
