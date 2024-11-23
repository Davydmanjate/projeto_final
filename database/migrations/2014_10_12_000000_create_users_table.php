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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 9);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();  // Permite nulo para logins via redes sociais
            $table->string('facebook_id')->nullable()->unique();  // ID do Facebook
            $table->string('facebook_token')->nullable();  // Token de acesso do Facebook
            $table->enum('auth_method', ['local', 'facebook'])->default('local');
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
