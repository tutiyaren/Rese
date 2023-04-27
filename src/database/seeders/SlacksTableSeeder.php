<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'users_id' => '1',
            'date' => '2023-03-01',
            'start_time' => '10:00:00',
            'end_time' => '20:00:00',
            'break_time' => '01:00:00',
            'working' => '09:00:00'
        ];
        DB::table('slack')->insert($param);
        $param = [
            'users_id' => '1',
            'date' => '2023-03-02',
            'start_time' => '09:30:00',
            'end_time' => '20:00:00',
            'break_time' => '01:00:00',
            'working' => '09:30:00'
        ];
        DB::table('slack')->insert($param);
        $param = [
            'users_id' => '1',
            'date' => '2023-03-3',
            'start_time' => '09:00:00',
            'end_time' => '20:00:00',
            'break_time' => '01:30:00',
            'working' => '09:30:00'
        ];
        DB::table('slack')->insert($param);
    }
}
