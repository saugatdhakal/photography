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
        Schema::create('customer_transations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')->constrained();
            $table->foreignId('transaction_id')->constrained();
            $table->enum('delivery_status',[false, true]);
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
        Schema::dropIfExists('customer_transations');
    }
};
