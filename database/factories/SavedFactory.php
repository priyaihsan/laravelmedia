<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Saved>
 */
class SavedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::inRandomOrder()->first()->id;
        $postid = User::whereNotIn('id', [$post])->pluck('id')->random();

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => $postid,
        ];
    }
}
