<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => '$2y$10$r9TsaTGnRzAzSEOCnAoZ8u6GOI3qiFYRJbGnhByELCHvDHIR6GPRy', // password
            'remember_token' => Str::random(10),
        ];
    }
}
