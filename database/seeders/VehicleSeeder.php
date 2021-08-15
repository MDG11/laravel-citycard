<?php

namespace Database\Seeders;

use Database\Factories\VehicleFactory;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = new VehicleFactory();
        for($i=0; $i<=100; $i++) $factory->create();
    }
}
