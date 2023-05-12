<?php

use App\Models\User;
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
            $table->string('name');
            $table->string('surnames')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('volunteer_code')->nullable();
            $table->string('hosting')->nullable();
            $table->string('sending')->nullable();
            $table->string('role')->nullable();
            $table->boolean('newUser')->default(true);
            $table->string('avatar')->default('/images/default-avatar.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Admin',
            'surnames' => 'Admin',
            'role' => 'superadmin',
            'email' => 'familiajordiescarra@gmail.com',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
