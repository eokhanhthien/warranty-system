<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('role')->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamp('verify_email_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->rememberToken();
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
