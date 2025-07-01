<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Members>
 */
class MembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'email'           => $this->faker->unique()->safeEmail,
            'phone'           => $this->faker->phoneNumber,
            'birth_date'      => $this->faker->date('Y-m-d', '-18 years'),
            'gender'          => $this->faker->randomElement(['Male', 'Female']),
            'address'         => $this->faker->address,
            'marital_status'  => $this->faker->randomElement(['Single', 'Married', 'Widowed', 'Divorced']),
            'spiritual_bday' => $this->faker->date('Y-m-d', 'now'),
            'status'          => $this->faker->randomElement(['Active', 'Inactive', 'Transferred']),
        ];
    }
}
