<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => '3D Background'
        ]);

        Category::create([
            'name' => 'Fan Art'
        ]);

        Category::create([
            'name' => 'Overlay'
        ]);

        Category::create([
            'name' => 'Banner'
        ]);

        Category::create([
            'name' => 'Poster'
        ]);
    }
}
