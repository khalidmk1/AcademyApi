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
        Schema::create('cours_padcast_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podcastvideo_id');
            $table->unsignedBigInteger('guest_id');
            $table->softDeletes();
            $table->foreign('guest_id')->references('id')->on('users');
            $table->foreign('podcastvideo_id')->references('id')->on('cours_padcast_videos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_padcast_guests');
    }
};
