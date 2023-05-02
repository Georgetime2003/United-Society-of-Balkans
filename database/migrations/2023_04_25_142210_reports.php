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
        Schema::create('reports', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->integer('week_number')->default(0);
            $table->string('monday_4')->nullable();
            $table->string('monday_2')->nullable();
            $table->string('tuesday_4')->nullable();
            $table->string('tuesday_2')->nullable();
            $table->string('wednesday_4')->nullable();
            $table->string('wednesday_2')->nullable();
            $table->string('thursday_4')->nullable();
            $table->string('thursday_2')->nullable();
            $table->string('friday_4')->nullable();
            $table->string('friday_2')->nullable();
            $table->string('extra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
