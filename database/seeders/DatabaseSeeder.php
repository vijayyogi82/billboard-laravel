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
        // \App\Models\User::factory(10)->create();
        $this->call(DefaultRole::class);
        $this->call(DefaultUser::class);
        $this->call(AppSettingSeederr::class);
        $this->call(DefaultCountry::class);
        $this->call(DefaultState::class);
        $this->call(DefaultCity::class);
    }
}
