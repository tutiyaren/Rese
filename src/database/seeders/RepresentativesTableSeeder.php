<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'admin_id' => '1',
            'name' => 'bcd',
            'email' => 'bcd@example.com',
            'password' => Hash::make('bcdbcdbcd')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'cde',
            'email' => 'cde@example.com',
            'password' => Hash::make('cdecdecde')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'def',
            'email' => 'def@example.com',
            'password' => Hash::make('defdefdef')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'efg',
            'email' => 'efg@example.com',
            'password' => Hash::make('efgefgefg')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'fgh',
            'email' => 'fgh@example.com',
            'password' => Hash::make('fghfghfgh')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'ghi',
            'email' => 'ghi@example.com',
            'password' => Hash::make('ghighighi')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'hij',
            'email' => 'hij@example.com',
            'password' => Hash::make('hijhijhij')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'ijk',
            'email' => 'ijk@example.com',
            'password' => Hash::make('ijkijkijk')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'jkl',
            'email' => 'jkl@example.com',
            'password' => Hash::make('jkljkljkl')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'klm',
            'email' => 'klm@example.com',
            'password' => Hash::make('klmklmklm')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'lmn',
            'email' => 'lmn@example.com',
            'password' => Hash::make('lmnlmnlmn')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'mno',
            'email' => 'mno@example.com',
            'password' => Hash::make('mnomnomno')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'nop',
            'email' => 'nop@example.com',
            'password' => Hash::make('nopnopnop')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'opq',
            'email' => 'opq@example.com',
            'password' => Hash::make('opqopqopq')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'pqr',
            'email' => 'pqr@example.com',
            'password' => Hash::make('pqrpqrpqr')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'qrs',
            'email' => 'qrs@example.com',
            'password' => Hash::make('qrsqrsqrs')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'rst',
            'email' => 'rst@example.com',
            'password' => Hash::make('rstrstrst')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'stu',
            'email' => 'stu@example.com',
            'password' => Hash::make('stustustu')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'tuv',
            'email' => 'tuv@example.com',
            'password' => Hash::make('tuvtuvtuv')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'uvw',
            'email' => 'uvw@example.com',
            'password' => Hash::make('uvwuvwuvw')
        ];
        DB::table('representatives')->insert($param);
        $param = [
            'admin_id' => '1',
            'name' => 'vwx',
            'email' => 'vwx@example.com',
            'password' => Hash::make('vwxvwxvwx')
        ];
        DB::table('representatives')->insert($param);
    }
}
