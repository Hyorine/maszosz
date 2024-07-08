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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('event')->default(false);
            $table->boolean('new_monster')->default(false);
            $table->boolean('watched_post')->default(false);
            $table->boolean('answered_post')->default(false);
            $table->boolean('friend_request')->default(false);
            $table->boolean('friend_accept')->default(false);
            $table->boolean('private_message')->default(false);
            $table->boolean('moderation')->default(false);
            $table->boolean('followed_user')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
