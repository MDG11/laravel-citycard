<?php

namespace Database\Seeders;

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
        $seed = new AdminSeeder();
        $seed->run();
        $seed = new CardTypeSeeder();
        $seed->run();
        $seed = new VehicleTypeSeeder();
        $seed->run();
        $seed = new PriceSeeder();
        $seed->run();
    }
}
