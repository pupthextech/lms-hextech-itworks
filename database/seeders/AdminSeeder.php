<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'first_name' => Str::random(5),
            'last_name' => Str::random(5),
            'gender' => 'male',
            'role' => 'admin',
            'stud_number' => 'admin123',
            'address' => 'General Santos Ave, Lower Bicutan, Taguig, Metro Manila',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password123'),
            'image' => 'none.png',
        ];

        User::create($user);
    }
}
