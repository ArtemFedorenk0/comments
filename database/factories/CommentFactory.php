<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'text' => fake()->text(),
            'url' => fake()->url(),
        ];
    }
}
