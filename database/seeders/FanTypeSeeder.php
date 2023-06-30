<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FanTypes;
use Illuminate\Support\Facades\DB;

class FanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fan_types')->insert([
            ['type' => 'Ceiling'],
            ['type' => 'Floor'],
            ['type' => 'Tower'],
            ['type' => 'Wall'],
            ['type' => 'Island'],
            ['type' => 'Box'],
            ['type' => 'Steam'],
            ['type' => 'Industry'],
            ['type' => 'Table'],
            ['type' => 'BatteryCharge'],
            ['type' => 'SolarPower'],
            ['type' => 'Conditioner'],
            ['type' => 'Air Cooler'],
            ['type' => 'Air Conditioning'],
            ['type' => 'Air Curtain'],
            ['type' => 'Ventilator'],
        ]);
    }
}
