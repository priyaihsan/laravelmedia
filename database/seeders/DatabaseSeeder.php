<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FollowSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoleUserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\SavedSeeder;
use Database\Seeders\TypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(FollowSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(FollowSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(SavedSeeder::class);
    }
}
