<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'abc',
            'email' => 'abc@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('abcabcabc')
        ];
        DB::table('admins')->insert($param);
    }
}
