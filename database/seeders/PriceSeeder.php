<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // a s c
        // b t
        Price::create([
            'card_type_id' => 1,
            'vehicle_type_id' => 1,
            'price' => 700,
        ]);
        Price::create([
            'card_type_id' => 2,
            'vehicle_type_id' => 1,
            'price' => 600,
        ]);
        Price::create([
            'card_type_id' => 3,
            'vehicle_type_id' => 1,
            'price' => 500,
        ]);
        Price::create([
            'card_type_id' => 1,
            'vehicle_type_id' => 2,
            'price' => 400,
        ]);
        Price::create([
            'card_type_id' => 2,
            'vehicle_type_id' => 2,
            'price' => 400,
        ]);
        Price::create([
            'card_type_id' => 3,
            'vehicle_type_id' => 2,
            'price' => 200,
        ]);
    }
}
