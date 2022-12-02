<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
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
            'taggable_type' => $condition ? Article::MORPH_TYPE : News::MORPH_TYPE,
            'taggable_id' => $condition ? Article::factory() : News::factory(),
            'name' => fake()->unique()->word(),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
