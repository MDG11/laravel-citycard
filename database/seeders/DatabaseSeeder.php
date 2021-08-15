<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'city' => 'Lutsk',
        ]);
        $seed = new AdminSeeder();
        $seed->run();
        $seed = new CardTypeSeeder();
        $seed->run();
        $seed = new VehicleTypeSeeder();
        $seed->run();
        $seed = new PriceSeeder();
        $seed->run();
        $seed = new VehicleSeeder();
        $seed->run();
        $seed = new CardSeeder();
        $seed->run();
    }
}
