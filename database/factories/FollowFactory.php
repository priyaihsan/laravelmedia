<?php

namespace Database\Factories;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first()->id;
        $followerid = User::whereNotIn('id', [$user])->pluck('id')->random();
        $followingid = User::whereNotIn('id', [$followerid])->pluck('id')->random();

        return [
            'follower_id' => $followerid,
            'following_id' => $followingid,
        ];
    }
}
