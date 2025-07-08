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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('username', 45);
            $table->string('password', 45);
            $table->string('photo', 128)->default('/user.default.jpg');
            $table->string('pppoe_username', 32)->default('')->comment('For PPPOE Login');
            $table->string('pppoe_password', 45)->default('')->comment('For PPPOE Login');
            $table->string('pppoe_ip', 32)->default('')->comment('For PPPOE Login');
            $table->string('fullname', 45);
            $table->mediumText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('phonenumber', 20)->default('0');
            $table->string('email', 128)->default('1');
            $table->string('coordinates', 50)->default('')->comment('Latitude and Longitude coordinates');
            $table->enum('account_type', ['Business', 'Personal'])->default('Personal')->comment('For selecting account type');
            $table->decimal('balance', 15, 2)->default(0.00)->comment('For Money Deposit');
            $table->enum('service_type', ['Hotspot', 'PPPoE', 'Others'])->default('Others')->comment('For selecting user type');
            $table->boolean('auto_renewal')->default(true)->comment('Auto renewall using balance');
            $table->enum('status', ['Active', 'Banned', 'Disabled', 'Inactive', 'Limited', 'Suspended'])->default('Active');
            $table->integer('created_by')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->datetime('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
