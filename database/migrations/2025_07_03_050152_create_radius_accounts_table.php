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
        Schema::create('radius_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('acctsessionid', 64)->default('');
            $table->string('username', 64)->default('');
            $table->string('realm', 128)->default('');
            $table->string('nasid', 32)->default('');
            $table->string('nasipaddress', 15)->default('');
            $table->string('nasportid', 32)->nullable();
            $table->string('nasporttype', 32)->nullable();
            $table->string('framedipaddress', 15)->default('');
            $table->bigInteger('acctsessiontime')->default(0);
            $table->bigInteger('acctinputoctets')->default(0);
            $table->bigInteger('acctoutputoctets')->default(0);
            $table->string('acctstatustype', 32)->nullable();
            $table->string('macaddr', 50);
            $table->timestamp('dateAdded')->useCurrent();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radius_accounts');
    }
};
