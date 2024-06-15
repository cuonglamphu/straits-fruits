<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['Category_Name' => 'Category A'],
            ['Category_Name' => 'Category B'],
            ['Category_Name' => 'Category C'],
            // Add more categories as needed
        ]);
    }
}
