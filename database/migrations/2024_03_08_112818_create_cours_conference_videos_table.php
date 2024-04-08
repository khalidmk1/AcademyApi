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
        Schema::create('cours_conference_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coursconference_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('video')->nullable();
            $table->text('tags')->nullable();
            $table->time('duration')->nullable();
            $table->softDeletes();
            $table->foreign('coursconference_id')->references('id')->on('cours_conferences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_conference_videos');
    }
};
