<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('invoices')->insert([
            ['Customer_Name' => 'Customer A', 'Total' => 100.00],
            ['Customer_Name' => 'Customer B', 'Total' => 150.50],
            // Add more invoices as needed
        ]);
    }
}
