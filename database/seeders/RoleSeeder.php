<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(RoleEnum::cases())->each(function ($role) {
            return Role::create(['name' => $role->toString()]);
        });
    }
}
