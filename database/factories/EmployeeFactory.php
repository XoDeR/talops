<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->unique()->firstName();
        $lastName = fake()->unique()->lastName();
        $fullName = "$firstName $lastName";
        $email = Str::slug($fullName) . '@' . fake()->safeEmailDomain();
        $phone = fake()->e164PhoneNumber();
        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ];
    }
}
