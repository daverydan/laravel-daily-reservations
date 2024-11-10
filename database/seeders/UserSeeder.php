<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('secret');

        collect([
            [
                'name' => 'Administrator',
                'email' => 'd@me.com',
                'password' => $password,
                'role_id' => 1,
            ],
            [
                'name' => 'Jon Deer',
                'email' => 'jon@deer.com',
                'password' => $password,
                'role_id' => 3,
            ],
        ])->each(fn ($user) => User::create($user));
    }
}
