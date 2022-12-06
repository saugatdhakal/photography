<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('cust_name');
            $table->string('cust_email');
            $table->string('payment_id');
            $table->string('payer_id');
            $table->string('amount');
            $table->string('address');
            $table->string('currency');
            $table->date('payment_date');
            $table->enum('payment_status', [false, true]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
