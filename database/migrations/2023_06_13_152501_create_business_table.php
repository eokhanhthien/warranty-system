<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->string('domain');
            $table->string('phone_number')->nullable();
            $table->unsignedInteger('business_category_id')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->string('owner_id')->nullable()->unique();
            $table->string('logo_image')->nullable();
            $table->string('bank')->nullable();
            $table->string('tax')->nullable();
            $table->timestamp('verify_email_at')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
