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
        Schema::create('cours_formations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cours_id');
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('program_id');
            $table->string('title')->nullable();
            $table->boolean('isCertify')->nullable()->default(false);
            $table->text('documents')->nullable();
            $table->string('image')->nullable();
            $table->text('condition')->nullable();
            $table->softDeletes();
            $table->foreign('cours_id')->references('id')->on('cours');
            $table->foreign('host_id')->references('id')->on('users');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_formations');
    }
};
