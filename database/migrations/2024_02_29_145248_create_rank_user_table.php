<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rank_user', function (Blueprint $table) {
            $table->id(); // Add a separate 'id' column as the primary key
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); // Make user_id unique
            $table->foreignId('rank_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rank_user');
    }
};
