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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->boolean('is_login')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('password_change')->default(false);
            $table->string('email')->unique();
            $table->date('datebirt')->nullable();
            $table->string('status_matrimonial')->nullable();
            $table->integer('Numchild')->nullable();
            $table->string('profission')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};