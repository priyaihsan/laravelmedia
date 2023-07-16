<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // menambahkan API unsplash untuk menggenerate gambar foto profile
        // composer require guzzlehttp/guzzle
        $client = new Client();
        $key = 'X35VAUCfRsxbBYyE17Ye1B0-l_cmQ9xRxZcKwd6U6AM';

        $response = $client->request('GET', 'https://api.unsplash.com/photos/random', [
            'query' => [
                'client_id' => $key,
                'query' => 'profile picture', // Kata kunci pencarian
                'orientation' => 'portrait', // Orientasi foto
            ],
        ]);
        // untuk mendekode respont json dari permintaan API unsplash
        $data = json_decode($response->getBody(), true);
        $profilePictureUrl = $data['urls']['regular'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'profile_picture' => $profilePictureUrl,
            // 'profile_picture'=> 'test link',
            'bio' => fake()->paragraph(mt_rand(2, 4)),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
