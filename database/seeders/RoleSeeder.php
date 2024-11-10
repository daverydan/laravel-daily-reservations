<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'administrator'],
            ['name' => 'company owner'],
            ['name' => 'customer'],
            ['name' => 'guide'],
        ])->each(fn ($role) => Role::create($role));
    }
}
