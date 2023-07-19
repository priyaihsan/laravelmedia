<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat role admin,artist,dan customer
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'Artist'
        ]);

        Role::create([
            'name' => 'Customer'
        ]);
    }
}
