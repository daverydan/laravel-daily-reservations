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
                'name' => 'Customer',
                'email' => 'customer@me.com',
                'password' => $password,
                'role_id' => Role::CUSTOMER->value,
            ],
            [
                'name' => 'Owner 1',
                'email' => 'owner1@me.com',
                'password' => $password,
                'company_id' => 1,
                'role_id' => Role::COMPANY_OWNER->value,
            ],
            [
                'name' => 'Guide 1',
                'email' => 'guide1@me.com',
                'password' => $password,
                'company_id' => 1,
                'role_id' => Role::GUIDE->value,
            ],
            [
                'name' => 'Owner 2',
                'email' => 'owner2@me.com',
                'password' => $password,
                'company_id' => 2,
                'role_id' => Role::COMPANY_OWNER->value,
            ],
            [
                'name' => 'Guide 2',
                'email' => 'guide2@me.com',
                'password' => $password,
                'company_id' => 2,
                'role_id' => Role::GUIDE->value,
            ],
            [
                'name' => 'Owner 3',
                'email' => 'owner3@me.com',
                'password' => $password,
                'company_id' => 3,
                'role_id' => Role::COMPANY_OWNER->value,
            ],
            [
                'name' => 'Guide 3',
                'email' => 'guide3@me.com',
                'password' => $password,
                'company_id' => 3,
                'role_id' => Role::GUIDE->value,
            ],
        ])->each(fn ($user) => User::create($user));
    }
}
