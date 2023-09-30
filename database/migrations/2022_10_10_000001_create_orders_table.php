<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
  public function up() {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('order_num', 50); //! create with new order dynamic
      $table->unsignedBigInteger('doctor_id');
      $table->unsignedBigInteger('region_id')->nullable();
      $table->string('name')->nullable();
      $table->string('phone_number')->nullable();
      $table->mediumText('address');
      $table->decimal('delivery')->default(40);
      $table->decimal('total_amount');
      $table->enum('status', ['delivered', 'in_progress', 'canceled'])->default('in_progress');
      
      $table->timestamp('delivery_confirmation')->nullable();
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
  }

  public function down() {
    Schema::dropIfExists('orders');
  }
}
