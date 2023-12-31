<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $temporaryPicture = "https://images.unsplash.com/photo-1471018238625-87ca40f13b31?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NjM3MTN8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA0MDMxNjJ8&ixlib=rb-4.0.3&q=80&w=1080";

        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'profile_picture' => $temporaryPicture,
                // 'profile_picture'=> 'test link',
                'bio' => fake()->paragraph(mt_rand(2, 4)),
            ]
        );
        User::create(
            [
                'name' => 'Priya Ihsan',
                'email' => 'priyaihsan@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'profile_picture' => $temporaryPicture,
                // 'profile_picture'=> 'test link',
                'bio' => fake()->paragraph(mt_rand(2, 4)),
            ]
        );
        User::factory(10)->create();
    }
}
