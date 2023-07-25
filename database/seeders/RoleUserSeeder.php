<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 2,
        ]);
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 3,
        ]);

        // me
        RoleUser::create([
            'user_id' => 2,
            'role_id' => 2,
        ]);


        RoleUser::create([
            'user_id' => 3,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 4,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 5,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 5,
            'role_id' => 2,
        ]);
        RoleUser::create([
            'user_id' => 6,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 7,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 8,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 9,
            'role_id' => 3,
        ]);
        RoleUser::create([
            'user_id' => 10,
            'role_id' => 3,
        ]);
    }
}
