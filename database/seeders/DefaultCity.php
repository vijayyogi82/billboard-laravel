<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class DefaultCity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'Delhi',
            'state' => 2,
            'added_by' => 1,
            'added_at' => now(),
        ]);
        City::create([
            'name' => 'Noida',
            'state' => 1,
            'added_by' => 1,
            'added_at' => now(),
        ]);
    }
}
