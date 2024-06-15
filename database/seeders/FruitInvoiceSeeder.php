<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitInvoiceSeeder extends Seeder
{
    public function run():void
    {
        DB::table('fruit_invoice')->insert([
            ['Invoice_ID' => 1, 'Fruit_ID' => 1, 'Quantity' => 2, 'Amount' => 5.00],
            ['Invoice_ID' => 1, 'Fruit_ID' => 2, 'Quantity' => 3, 'Amount' => 5.25],
            // Add more entries as needed
        ]);
    }
}
