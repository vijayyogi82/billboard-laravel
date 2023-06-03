<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name' => 'Super Admin',
        'email' => 'admin@diginex.com', 
        'password' => bcrypt('admin@123'),
        'phone' => '1234567890',
        'contact_person' => 'Super Admin',
        'role_id' => 1,
        'role_name' => 'Super Admin',
        'name_of_company' => 'Super Admin',
        'register_name' => 'Super Admin',
        'vat_gst_number' => '134567899',
        'added_by' => 1,
        'added_at' => now(),
        ]);
    }
}
