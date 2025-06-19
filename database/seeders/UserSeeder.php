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
        $admin = User::create([
            'first_name' => "Bill",
            'last_name' => "Gates",
            'phone' => "998971234567",
            'password' => "1234567",
        ]);
        $admin->assignRole('admin');

        $admin = User::create([
            'first_name' => "Stieve",
            'last_name' => "Jobs",
            'phone' => "998971234568",
            'password' => "1234567",
        ]);
        $admin->assignRole('user');
    }
}
