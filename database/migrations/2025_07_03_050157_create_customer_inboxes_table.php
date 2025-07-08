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
        Schema::create('customer_inboxes', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->datetime('date_created');
            $table->datetime('date_read')->nullable();
            $table->string('subject', 64);
            $table->text('body')->nullable();
            $table->string('from', 8)->default('System')->comment('System or Admin or Else');
            $table->integer('admin_id')->default(0)->comment('other than admin is 0');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_inboxes');
    }
};
