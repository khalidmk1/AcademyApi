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
        Schema::create('cours_formation_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('CourFormation_id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->longText('tags')->nullable();
            $table->string('video')->nullable();
            $table->softDeletes();
            $table->foreign('CourFormation_id')->references('id')->on('cours_formations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_formation_videos');
    }
};
