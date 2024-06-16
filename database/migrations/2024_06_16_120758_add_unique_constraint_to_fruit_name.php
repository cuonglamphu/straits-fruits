<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToFruitName extends Migration
{
    public function up()
    {
        Schema::table('fruits', function (Blueprint $table) {
            $table->string('Fruit_Name')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['Fruit_Name']);
        });
    }
}
