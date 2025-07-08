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
        Schema::create('user_recharges', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('username', 32);
            $table->integer('plan_id');
            $table->string('namebp', 40);
            $table->date('recharged_on');
            $table->time('recharged_time')->default('00:00:00');
            $table->date('expiration');
            $table->time('time');
            $table->string('status', 20);
            $table->string('method', 128)->default('');
            $table->string('routers', 32);
            $table->string('type', 15);
            $table->integer('admin_id')->default(1);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_recharges');
    }
};
