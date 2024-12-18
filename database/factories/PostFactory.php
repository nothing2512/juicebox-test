<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'userId' => fake()->randomNumber(5),
            'title' => fake()->text(),
            'content' => fake()->text(),
            'cover' => fake()->text(),
        ];
    }
}
