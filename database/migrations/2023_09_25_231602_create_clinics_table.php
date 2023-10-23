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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string('booking_link')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('location_link')->nullable();
            $table->string('address')->nullable();
            $table->decimal('lat', 12, 10)->nullable();
            $table->decimal('lng', 12, 10)->nullable();
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
        Schema::dropIfExists('clinics');
    }
};
