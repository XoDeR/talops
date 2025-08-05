<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        $address = fake()->streetAddress() . " " . fake()->postcode() . " " . fake()->city() . " " . fake()->country();
        $email = fake()->unique()->safeEmail();
        $domain = str_replace('-', '', Str::slug($name));
        $website = 'https://www.' . $domain . '.com';
        return [
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'website' => $website,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return static
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Company $company) {
            // This runs after the model is created and saved
            // Logo
            $company->logo()->create(
                Logo::factory()->make()->toArray()
            );
            // Employees
            $company->employees()->createMany(
                Employee::factory(rand(10, 25))->make()->toArray()
            );
        });
    }
}
