<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hari')->insert([
            [
                'id' => 1,
                'hari' => 'Senin',
                'day' => 'Monday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 2,
                'hari' => 'Selasa',
                'day' => 'Tuesday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 3,
                'hari' => 'Rabu',
                'day' => 'Wednesday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 4,
                'hari' => 'Kamis',
                'day' => 'Thursday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 5,
                'hari' => 'Jumat',
                'day' => 'Friday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 6,
                'hari' => 'Sabtu',
                'day' => 'Saturday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ],
            [
                'id' => 7,
                'hari' => 'Minggu',
                'day' => 'Sunday',
                'created_at' => '2022-10-01 00:00:00',
                'updated_at' => '2022-10-01 00:00:00'
            ]
        ]);
    }
}
