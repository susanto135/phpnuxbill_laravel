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
        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('ip_address', 128);
            $table->string('username', 50);
            $table->string('password', 60);
            $table->string('description', 256)->nullable();
            $table->string('coordinates', 50)->default('');
            $table->enum('status', ['Online', 'Offline'])->default('Online');
            $table->datetime('last_seen')->nullable();
            $table->string('coverage', 8)->default('0');
            $table->boolean('enabled')->default(true)->comment('0 disabled');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routers');
    }
};
