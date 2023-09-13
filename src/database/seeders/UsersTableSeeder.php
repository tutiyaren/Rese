<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'aaa',
            'email' => 'aaa@example.com', 
            'password' => Hash::make('aaaaaaaa')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'bbb',
            'email' => 'bbb@example.com',
            'password' => Hash::make('bbbbbbbb')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'ccc',
            'email' => 'ccc@example.com',
            'password' => Hash::make('cccccccc')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'ddd',
            'email' => 'ddd@example.com',
            'password' => Hash::make('dddddddd')
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'eee',
            'email' => 'eee@example.com',
            'password' => Hash::make('eeeeeeee')
        ];
        DB::table('users')->insert($param);
    }
}
