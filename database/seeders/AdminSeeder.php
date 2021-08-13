<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = new AdminFactory();
        for($i=0;$i<10;$i++) $factory->create();
    }
}
