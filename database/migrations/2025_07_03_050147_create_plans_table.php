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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name_plan', 40);
            $table->integer('id_bw');
            $table->string('price', 40);
            $table->string('price_old', 40)->default('');
            $table->enum('type', ['Hotspot', 'PPPOE', 'Balance']);
            $table->enum('typebp', ['Unlimited', 'Limited'])->nullable();
            $table->enum('limit_type', ['Time_Limit', 'Data_Limit', 'Both_Limit'])->nullable();
            $table->unsignedInteger('time_limit')->nullable();
            $table->enum('time_unit', ['Mins', 'Hrs'])->nullable();
            $table->unsignedInteger('data_limit')->nullable();
            $table->enum('data_unit', ['MB', 'GB'])->nullable();
            $table->integer('validity');
            $table->enum('validity_unit', ['Mins', 'Hrs', 'Days', 'Months', 'Period']);
            $table->integer('shared_users')->nullable();
            $table->string('routers', 32);
            $table->boolean('is_radius')->default(false)->comment('1 is radius');
            $table->string('pool', 40)->nullable();
            $table->integer('plan_expired')->default(0);
            $table->tinyInteger('expired_date')->default(20);
            $table->boolean('enabled')->default(true)->comment('0 disabled');
            $table->enum('prepaid', ['yes', 'no'])->default('yes')->comment('is prepaid');
            $table->enum('plan_type', ['Business', 'Personal'])->default('Personal')->comment('For selecting account type');
            $table->string('device', 32)->default('');
            $table->text('on_login')->nullable();
            $table->text('on_logout')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
