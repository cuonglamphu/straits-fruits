<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitsSeeder extends Seeder
{
    public function run():void
    {
        DB::table('fruits')->insert([
            ['Fruit_Name' => 'Apple', 'Price' => 2.50, 'Category_ID' => 1, 'Unit_ID' => 1],
            ['Fruit_Name' => 'Banana', 'Price' => 1.75, 'Category_ID' => 1, 'Unit_ID' => 1],
            // Add more fruits as needed
        ]);
    }
}

