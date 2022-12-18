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
        Schema::create('aurthors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('dob');
            $table->string('email');
            $table->longText('sub_title');
            $table->longText('description');
            $table->string('speciality');
            $table->string('address');
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('aurthors');
    }
};
