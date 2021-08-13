<?php

namespace Database\Seeders;

use App\Models\CardType;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CardType::create([
            'type' => 'adult',
        ]);
        CardType::create([
            'type' => 'student',
        ]);
        CardType::create([
            'type' => 'child',
        ]);
    }
}
