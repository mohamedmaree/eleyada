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
        Schema::create('pregnant_weeks_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable();
            $table->text('name')->nullable();
            $table->text('mother_info')->nullable();
            $table->text('baby_info')->nullable();
            $table->string('baby_weight')->nullable();
            $table->string('baby_height')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('pregnant_weeks_infos');
    }
};
