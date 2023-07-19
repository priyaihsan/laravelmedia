<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // menambahkan API unsplash untuk menggenerate gambar foto profile
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

        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'profile_picture' => $profilePictureUrl,
                // 'profile_picture'=> 'test link',
                'bio' => fake()->paragraph(mt_rand(2,4)),
            ]
        );
        User::create(
            [
                'name' => 'Priya Ihsan',
                'email' => 'priyaihsan@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'profile_picture' => $profilePictureUrl,
                // 'profile_picture'=> 'test link',
                'bio' => fake()->paragraph(mt_rand(2,4)),
            ]
        );
        User::factory(10)->create();
    }
}
