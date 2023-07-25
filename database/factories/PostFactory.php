<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(mt_rand(1, 4)),
            'content' => fake()->paragraph(mt_rand(3, 4)),
            'user_id' => User::inRandomOrder()->first()->id,
            'type_id' => Type::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
