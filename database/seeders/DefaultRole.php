<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class DefaultRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => "Super Admin",
            "level" => 1,
            "added_by" => 1,
            "added_at" => now(),
        ]);

        Role::create([
            "name" => "Businessman",
            "level" => 2,
            "added_by" => 1,
            "added_at" => now(),
        ]);
        Role::create([
            "name" => "Advertising Agency",
            "level" => 3,
            "added_by" => 1,
            "added_at" => now(),
        ]);
        Role::create([
            "name" => "Brand/Organisation",
            "level" => 4,
            "added_by" => 1,
            "added_at" => now(),
        ]);
    }
}
