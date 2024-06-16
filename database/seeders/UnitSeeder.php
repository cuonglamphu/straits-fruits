<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run():void
    {
        DB::table('units')->insert([
            ['Unit_Name' => 'pcs'],
            ['Unit_Name' => 'kg'],
            ['Unit_Name' => 'pack'],
            // Add more units as needed
        ]);
    }
}
