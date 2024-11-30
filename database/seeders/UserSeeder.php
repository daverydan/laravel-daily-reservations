<?php

namespace Database\Seeders;

use App\Enums\Role;
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
                'email' => 'admin@me.com',
                'password' => $password,
                'role_id' => Role::ADMINISTRATOR->value,
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@me.com',
                'password' => $password,
                'company_id' => 1,
                'role_id' => Role::COMPANY_OWNER->value,
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@me.com',
                'password' => $password,
                'role_id' => Role::CUSTOMER->value,
            ],
            [
                'name' => 'Guide',
                'email' => 'guide@me.com',
                'password' => $password,
                'role_id' => Role::GUIDE->value,
            ],
        ])->each(fn ($user) => User::create($user));
    }
}
