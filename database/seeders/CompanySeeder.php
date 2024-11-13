<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Acme Inc.',
            ],
            [
                'name' => 'Apple',
            ],
            [
                'name' => 'Microsoft',
            ],
        ])->each(fn ($company) => Company::create($company));
    }
}
