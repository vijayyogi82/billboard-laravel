<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class DefaultState extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name' => 'Delhi',
            'country' => 1,
            'added_by' => 1,
            'added_at' => now(),
        ]);
        State::create([
            'name' => 'UP',
            'country' => 1,
            'added_by' => 1,
            'added_at' => now(),
        ]);
    }
}
