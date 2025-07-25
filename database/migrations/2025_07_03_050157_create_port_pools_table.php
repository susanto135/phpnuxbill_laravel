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
        Schema::create('port_pools', function (Blueprint $table) {
            $table->id();
            $table->string('public_ip', 40);
            $table->string('port_name', 40);
            $table->string('range_port', 40);
            $table->string('routers', 40);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_pools');
    }
};
