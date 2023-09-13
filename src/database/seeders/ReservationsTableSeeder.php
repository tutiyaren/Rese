<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
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
            'date' => '2023-09-30',
            'time' => '17:00',
            'number' => '3'
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '1',
            'date' => '2023-10-01',
            'time' => '17:00',
            'number' => '1'
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '2',
            'shop_id' => '2',
            'date' => '2023-10-01',
            'time' => '18:30',
            'number' => '2'
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '1',
            'date' => '2023-10-01',
            'time' => '17:00',
            'number' => '4'
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '2',
            'date' => '2023-10-02',
            'time' => '17:30',
            'number' => '2'
        ];
        DB::table('reservations')->insert($param);
        $param = [
            'user_id' => '3',
            'shop_id' => '3',
            'date' => '2023-10-03',
            'time' => '18:00',
            'number' => '2'
        ];
        DB::table('reservations')->insert($param);
    }
}
