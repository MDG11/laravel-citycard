<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $base = strtoupper($this->faker->randomLetter.$this->faker->randomLetter);
        return [
            'licence_plate_number' => $base.$this->faker->numberBetween($min = 1000, $max = 9999).strtoupper($this->faker->randomLetter.$this->faker->randomLetter) ,
            'vehicle_type_id' => VehicleType::all()->random()->id,
            'city_id' => City::all()->random()->id,
        ];
    }
}
