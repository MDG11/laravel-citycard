<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\CardType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_code' => $this->faker->swiftBicNumber(),
            'card_type_id' => CardType::all()->random()->id,
        ];
    }
}
