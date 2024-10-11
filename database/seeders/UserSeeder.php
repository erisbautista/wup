<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Application',
            'middle_name' => '',
            'last_name' => 'Administrator',
            'email' => 'admin@wup.com',
            'level' => 'admin',
            'role_id' => 1,
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => Date::now(),
        ]);
    }
}
