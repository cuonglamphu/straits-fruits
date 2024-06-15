<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fruits', function (Blueprint $table) {
            $table->id(); // Creates `Fruit_ID` INT AUTO_INCREMENT PRIMARY KEY
            $table->string('Fruit_Name', 255);
            $table->float('Price');
            $table->foreignId('category_id')->constrained('categories'); // Foreign key to Categories table
            $table->foreignId('unit_id')->constrained('units'); // Foreign key to Unit table
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fruits');
    }
};
