<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Supervisor',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'supervisor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
