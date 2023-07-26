<?php

namespace Database\Factories;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
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
        $key = '1GEdHPZQmoKAK2rdGRqru1P7CrT8SuHx8b_jng1LfD8';

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
        $temporaryPicture = "https://images.unsplash.com/photo-1471018238625-87ca40f13b31?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NjM3MTN8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA0MDMxNjJ8&ixlib=rb-4.0.3&q=80&w=1080";

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'profile_picture' => $temporaryPicture,
            // 'profile_picture'=> 'test link',
            'bio' => fake()->paragraph(mt_rand(2, 4)),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
