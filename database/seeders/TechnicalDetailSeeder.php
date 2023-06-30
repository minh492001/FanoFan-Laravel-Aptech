<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnicalDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('technical_details')->insert([
            'width' => '200cm',
            'wind_speed' => 9,
            'wind_flow' => '345m3/min',
            'number_of_fans' => 8,
            'fan_materials' => 'Fiberglass(PPG)',
            'color' => 'Black/White',
            'weigh' => '14,6kg',
            'from' => 'Japan',
            'manufacturer' => 'Malaysia',
            'guarantee' => '24 months'
        ]);
    }
}
