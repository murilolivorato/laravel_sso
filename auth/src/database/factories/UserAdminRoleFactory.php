<?php

namespace Database\Factories;

use App\Models\UserAdminRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAdminRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAdminRole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'        => $this->faker->unique()->word() ,
            'label'        => $this->faker->unique()->word()
        ];
    }
}
