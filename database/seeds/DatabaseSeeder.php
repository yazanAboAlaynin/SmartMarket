<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'moderator',
            'email' => 'moderator@smartmarket.com',
            'password' => Hash::make('moderator'),
            'mobile' => '09',
            'moderator' => '1',
        ]);
    }
}
