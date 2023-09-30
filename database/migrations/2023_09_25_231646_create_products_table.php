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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->text('details')->nullable();
            $table->text('benefits')->nullable();
            $table->decimal('price')->nullable();
            $table->string('video')->nullable();

            $table->string('icon')->nullable();
            $table->string('insertion_technique')->nullable();
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->unsignedBigInteger('product_custom_field_id')->nullable();

            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->integer('order')->nullable()->default(0);

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
        Schema::dropIfExists('products');
    }
};
