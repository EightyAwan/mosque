<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mailinator.com',
            'phone_number' => '613-555-0130', 
            'color' => null,
            'email_verified_at' => Carbon::now(),
            'role_id' => 0,
            'password' => Hash::make('admin123'),
            'created_at' => Carbon::now()
        ]);
    }
}
