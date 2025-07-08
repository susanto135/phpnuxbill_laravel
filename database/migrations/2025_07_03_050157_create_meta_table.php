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
        Schema::create('meta', function (Blueprint $table) {
            $table->id();
            $table->string('tbl', 32)->comment('Table name');
            $table->integer('tbl_id')->comment('table value id');
            $table->string('name', 32);
            $table->mediumText('value')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta');
    }
};
