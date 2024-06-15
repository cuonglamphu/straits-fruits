<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fruit_invoice', function (Blueprint $table) {
            $table->foreignId('invoice_id')->constrained('invoices'); // Foreign key to Invoice table
            $table->foreignId('fruit_id')->constrained('fruits'); // Foreign key to Fruits table
            $table->integer('Quantity');
            $table->decimal('Amount', 15, 2);
            $table->primary(['invoice_id', 'fruit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fruit_invoice');
    }
};
