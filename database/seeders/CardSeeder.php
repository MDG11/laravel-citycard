<?php

namespace Database\Seeders;

use Database\Factories\CardFactory;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = new CardFactory();
        for($i=0; $i<=100; $i++) $factory->create();
    }
}
