<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class DefaultCountry extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'India',
            'added_by' => 1,
            'added_at' => now(),
        ]);
    }
}
