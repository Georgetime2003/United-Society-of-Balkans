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
        Schema::create('periodic_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->notNullable();
            $table->foreignId('organization_id')->constrained('users')->notNullable();
            $table->boolean('type')->comment('0: mid-term, 1: final')->notNullable();
            $table->string('answer1')->nullable();
            $table->string('answer2')->nullable();
            $table->string('answer3')->nullable();
            $table->string('answer4')->nullable();
            $table->string('answer5')->nullable();
            $table->string('answer6')->nullable();
            $table->string('status')->default('pending');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodic_reports');
    }
};
