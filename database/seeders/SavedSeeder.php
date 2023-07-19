<?php

namespace Database\Seeders;

use App\Models\Saved;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saved::factory(30)->create();
    }
}
