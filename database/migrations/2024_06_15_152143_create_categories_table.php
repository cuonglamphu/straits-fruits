<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Creates `Category_ID` INT AUTO_INCREMENT PRIMARY KEY
            $table->string('Category_Name', 255);
            $table->timestamps(); // Optional: Adds `created_at` and `updated_at` columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};




