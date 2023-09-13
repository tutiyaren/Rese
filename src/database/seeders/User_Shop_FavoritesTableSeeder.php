<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_Shop_FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'shop_id' => '1',
        ];
        DB::table('user_shop_favorites')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '1',
        ];
        DB::table('user_shop_favorites')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '2',
        ];
        DB::table('user_shop_favorites')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '1',
        ];
        DB::table('user_shop_favorites')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '2',
        ];
        DB::table('user_shop_favorites')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '3',
        ];
        DB::table('user_shop_favorites')->insert($param);
    }
}
