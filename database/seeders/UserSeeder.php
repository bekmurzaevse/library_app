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
        User::create([
            'first_name' => "Bill",
            'last_name' => "Gates",
            'phone' => "998971234567",
            'password' => "1234567",
        ]);
    }
}
