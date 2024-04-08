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
        Schema::create('cours_padcast_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podacast_id');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('tags')->nullable();
            $table->text('description')->nullable();
            $table->text('duration')->nullable();
            $table->string('video')->nullable();
            $table->softDeletes();
            $table->foreign('podacast_id')->references('id')->on('cours_podcasts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_padcast_videos');
    }
};
