<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1)->comment("1-active, 2-inactive");
            $table->tinyInteger('type')->comment("1 - individual, 2 - organisation");
            $table->tinyInteger('signup_steps')->default(3);
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('last_login')->nullable();
            $table->string('signup_source')->nullable()->comment("web|android|ios");
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
        Schema::dropIfExists('users');
    }
}
