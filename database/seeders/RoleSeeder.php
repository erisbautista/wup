<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'created_at' => Date::now(),
            ],
            [
                'id' => 2,
                'name' => 'student',
                'created_at' => Date::now(),
            ],
            [
                'id' => 3,
                'name' => 'teacher',
                'created_at' => Date::now(),
            ]
        ]);
    }
}
