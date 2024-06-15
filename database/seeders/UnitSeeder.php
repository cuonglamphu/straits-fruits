<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run():void
    {
        DB::table('units')->insert([
            ['Unit_Name' => 'Unit A'],
            ['Unit_Name' => 'Unit B'],
            ['Unit_Name' => 'Unit C'],
            // Add more units as needed
        ]);
    }
}
