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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->integer('orders')->default(99);
            $table->tinyInteger('position')->default(1)->comment('1. top 2. left 3. right 4. bottom');
            $table->enum('user', ['Admin', 'Agent', 'Sales', 'Customer'])->default('Admin');
            $table->boolean('enabled')->default(true);
            $table->string('title', 64);
            $table->string('widget', 64)->default('');
            $table->text('content');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
