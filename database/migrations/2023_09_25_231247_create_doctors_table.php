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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('country_code',5)->default('002');
            $table->integer('country_id')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email',50);
            $table->string('password',100);

            $table->string('identity_proof')->nullable();
            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->unsignedBigInteger('academic_degree_id')->nullable();

            $table->string('image', 50)->default('default.png');
            $table->boolean('active')->default(0);
            $table->boolean('is_blocked')->default(0);
            $table->boolean('is_approved')->default(1);
            $table->string('lang', 2)->default('ar');
            $table->boolean('is_notify')->default(true);
            $table->string('code', 10)->nullable();
            $table->timestamp('code_expire')->nullable();
            $table->decimal('wallet_balance', 9,2)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
