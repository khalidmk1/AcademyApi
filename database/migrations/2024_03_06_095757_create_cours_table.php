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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('isshort')->nullable()->default(false);
            $table->unsignedBigInteger('category_id');
            $table->text('gaols_id')->nullable();
            $table->string('cours_type')->nullable();
            $table->boolean('isActive')->nullable()->default(true);
            $table->boolean('isComing')->nullable()->default(false);
            $table->boolean('pricing')->nullable()->default(false);
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
