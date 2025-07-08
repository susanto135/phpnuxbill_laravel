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
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('username', 32);
            $table->integer('user_id')->default(0);
            $table->string('gateway', 32)->comment('xendit | midtrans');
            $table->string('gateway_trx_id', 512)->default('');
            $table->integer('plan_id');
            $table->string('plan_name', 40);
            $table->integer('routers_id');
            $table->string('routers', 32);
            $table->string('price', 40);
            $table->string('pg_url_payment', 512)->default('');
            $table->string('payment_method', 32)->default('');
            $table->string('payment_channel', 32)->default('');
            $table->text('pg_request')->nullable();
            $table->text('pg_paid_response')->nullable();
            $table->datetime('expired_date')->nullable();
            $table->datetime('created_date');
            $table->datetime('paid_date')->nullable();
            $table->string('trx_invoice', 25)->default('')->comment('from tbl_transactions');
            $table->tinyInteger('status')->default(1)->comment('1 unpaid 2 paid 3 failed 4 canceled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
