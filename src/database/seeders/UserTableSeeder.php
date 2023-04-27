<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'テスト太郎',
            'email' => 'example@com',
            'password' => 'testtaro'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト一郎',
            'email' => 'example1@com',
            'password' => 'testone'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'テスト次郎',
            'email' => 'example2@com',
            'password' => 'testtwo'
        ];
        DB::table('users')->insert($param);

        
    }
}
