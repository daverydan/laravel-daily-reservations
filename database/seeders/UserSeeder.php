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
                'email' => 'd@me.com',
                'password' => $password,
                'role_id' => Role::ADMINISTRATOR->value,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jn@me.com',
                'password' => $password,
                'role_id' => Role::COMPANY_OWNER->value,
            ],
            [
                'name' => 'John Deer',
                'email' => 'jd@me.com',
                'password' => $password,
                'role_id' => Role::CUSTOMER->value,
            ],
        ])->each(fn ($user) => User::create($user));
    }
}
