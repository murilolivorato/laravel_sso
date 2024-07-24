<?php

namespace Database\Factories;

use App\Classes\Utilities\DBStatus;
use App\Models\UserAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAdmin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => Hash::make('123456') ,
            'remember_token' => Str::random(10),
            'folder'         => $this->faker->unique()->word(),
            'status'         => $this->faker->randomElement(DBStatus::all())['value']
        ];
    }
}
