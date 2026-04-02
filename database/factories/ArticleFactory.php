<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(8),
            'excerpt' => fake()->text(150),
            'content' => fake()->paragraphs(4, true),
            'image_url' => 'https://placehold.co/600x400/cccccc/000000?text=News+Image',
            'category' => fake()->randomElement(['CHINA', 'SOURCE', 'OP-ED', 'WORLD', 'SPORT']),
            'is_featured' => fake()->boolean(10), // 10% chance to be a featured article
        ];
    }
}
