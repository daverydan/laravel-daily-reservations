<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // passes tests
        $guide = User::firstWhere('role_id', Role::GUIDE);

        return [
            'company_id' => Company::factory(),
            'guide_id' => $guide->id,
            'name' => $guide->name,
            'description' => fake()->text(),
            'start_time' => Carbon::now()->addMonth(),
            'price' => fake()->randomNumber(5),
        ];

        // TODO: Does NOT pass tests, but seeds data properly for frontend
        // $company_id = Company::all()->random()->id;
        // $guide = User::where('company_id', $company_id)->where('role_id', Role::GUIDE)->first();

        // return [
        //     'company_id' => $company_id,
        //     'guide_id' => $guide->id,
        //     'name' => $guide->name,
        //     'description' => fake()->text(),
        //     'start_time' => Carbon::now()->addMonth(),
        //     'price' => fake()->randomNumber(5),
        // ];
    }
}
