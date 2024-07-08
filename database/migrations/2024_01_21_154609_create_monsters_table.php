<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonstersTable extends Migration
{
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to link with users table
            $table->string('name')->unique();
            $table->text('description');
            $table->string('place'); // Assuming this is the translation for 'ellőfurdulás'
            $table->text('behavior'); // Translation for 'viselkedés'
            $table->integer('rarity_level')->default(5); // Translation for 'ritkasági_szint'
            $table->integer('danger_level')->default(5); // Translation for 'veszélyességi_szint'
            $table->string('nutrition'); // Translation for 'táplálkozás'
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}