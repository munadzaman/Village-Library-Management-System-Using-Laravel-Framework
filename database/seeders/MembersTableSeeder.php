<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 dummy members using the MemberFactory
        \App\Models\Member::factory(10)->create();
    }
}
