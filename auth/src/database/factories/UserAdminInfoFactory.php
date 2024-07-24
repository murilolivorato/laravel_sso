<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAdminInfo>
 */
class UserAdminInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'           => $this->faker->unique()->word(),
            'last_name'      => $this->faker->lastName(),
            'phone'          => $this->faker->phoneNumber,
            'cpf'            => $this->faker->unique()->numberBetween(1,400),
            'user_id'        => 1
        ];
    }
}
