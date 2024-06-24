<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'first_name' => 'buckhill',
            'last_name' => 'petshop',
            'email' => 'petshop@buckhill.com',
            'password' => bcrypt('petshop'),
            'is_admin' => 0,
            'email_verified_at' => now(),
            'last_login_at' => null,
            'is_marketing' => 0,
        ]);

        User::factory(10)->create();
    }
}
