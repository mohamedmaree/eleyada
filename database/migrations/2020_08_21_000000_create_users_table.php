<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name',50);
      $table->enum('type',['pregnant','non-pregnant','normal'])->default('normal');
      $table->string('country_code',5)->default('002');
      $table->integer('country_id')->nullable();
      $table->integer('category_id')->nullable();
      $table->string('phone',15)->nullable();
      $table->string('email',50);
      $table->string('password',100);
      $table->string('image', 50)->default('default.png');
      $table->boolean('active')->default(0);
      $table->boolean('is_blocked')->default(0);
      $table->boolean('is_approved')->default(1);
      $table->string('lang', 2)->default('ar');
      $table->boolean('is_notify')->default(true);
      $table->string('code', 10)->nullable();
      $table->timestamp('code_expire')->nullable();
      $table->decimal('lat', 10, 8)->nullable();
      $table->decimal('lng', 10, 8)->nullable();
      $table->string('map_desc', 50)->nullable();
      $table->decimal('wallet_balance', 9,2)->default(0);
      $table->timestamp('email_verified_at')->nullable();
      
      $table->date('start_pregnant_date')->nullable();
      $table->date('period_date')->nullable();
      $table->dateTime('intercourse_date')->nullable();
      
      $table->integer('period_cycle_length')->nullable();
      $table->integer('period_length')->nullable();
      
      $table->boolean('pill_notifications')->default(true);
      $table->dateTime('pill_taken_date')->nullable();
      $table->string('pill_type')->nullable();
      
      $table->boolean('iud_inspection_notifications')->default(true);
      $table->date('iud_installed_date')->nullable();
      $table->string('iud_type')->nullable();

      $table->boolean('injection_notifications')->default(true);
      $table->date('last_visit_doctor_date')->nullable();
      
      $table->string('care_giver_name')->nullable();
      $table->string('care_giver_email')->nullable();

      $table->softDeletes();
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
  }

  public function down() {
    Schema::dropIfExists('users');
  }
}
