<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brands;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['Brand_name' => 'Panasonic'],
            ['Brand_name' => 'Beurer'],
            ['Brand_name' => 'Fukata'],
            ['Brand_name' => 'Haichi'],
            ['Brand_name' => 'Koenic'],
            ['Brand_name' => 'Kosmo'],
            ['Brand_name' => 'Chika'],
            ['Brand_name' => 'Ching Hai'],
            ['Brand_name' => 'Dreamer'],
            ['Brand_name' => 'Haiki'],
            ['Brand_name' => 'Hasaki'],
            ['Brand_name' => 'Toshiba'],
            ['Brand_name' => 'Midea'],
            ['Brand_name' => 'Hatari'],
            ['Brand_name' => 'Nakami'],
            ['Brand_name' => 'Nanoco'],
            ['Brand_name' => 'Steba'],
            ['Brand_name' => 'Xiaomi'],
            ['Brand_name' => 'Mitsubishi'],
            ['Brand_name' => 'Natifan'],
            ['Brand_name' => 'Sowun'],
            ['Brand_name' => 'Tolsen'],
            ['Brand_name' => 'Unie'],
            ['Brand_name' => 'Wing'],
            ['Brand_name' => 'Alaska'],
            ['Brand_name' => 'Kadeka'],
            ['Brand_name' => 'NIQ'],
        ]);
    }
}
