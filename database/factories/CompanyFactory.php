<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $address = fake()->streetAddress() . fake()->postcode() . fake()->city() . fake()->country();
        $email = fake()->unique()->safeEmail();
        $website = fake()->url();
        return [
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'website' => $website,
        ];
    }
}
