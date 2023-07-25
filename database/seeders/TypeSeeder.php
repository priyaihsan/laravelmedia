<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'name' => 'Vidio'
        ]);

        Type::create([
            'name' => 'Image'
        ]);

        Type::create([
            'name' => 'Gift'
        ]);

        Type::create([
            'name' => 'Audio'
        ]);
    }
}
