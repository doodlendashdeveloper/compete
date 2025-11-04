<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelUsers;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelUsers::create([
            'name' => 'admin',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('password'),
            'user_type' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

      

    }
}
