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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice', 25);
            $table->string('username', 32);
            $table->integer('user_id')->default(0);
            $table->string('plan_name', 40);
            $table->string('price', 40);
            $table->date('recharged_on');
            $table->time('recharged_time')->default('00:00:00');
            $table->date('expiration');
            $table->time('time');
            $table->string('method', 128);
            $table->string('routers', 32);
            $table->enum('type', ['Hotspot', 'PPPOE', 'Balance']);
            $table->string('note', 256)->default('')->comment('for note');
            $table->integer('admin_id')->default(1);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
