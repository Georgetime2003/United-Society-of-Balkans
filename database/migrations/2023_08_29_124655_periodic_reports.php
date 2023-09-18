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
            $table->boolean('type')->unique()->comment('0: mid-term, 1: final')->notNullable();
            $table->string('answer1')->notNullable();
            $table->string('answer2')->notNullable();
            $table->string('answer3')->notNullable();
            $table->string('answer4')->notNullable();
            $table->string('answer5')->notNullable();
            $table->string('status')->default('pending');
            $table->string('comment')->Nullable();
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
