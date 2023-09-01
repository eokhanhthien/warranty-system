<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('order_code');
            $table->date('order_date')->nullable();
            $table->string('status');
            $table->boolean('is_completed')->default(false);
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->string('note');
            $table->string('pay_method');
            $table->string('discount_code')->nullable();
            $table->integer('total_price');
            $table->unsignedBigInteger('business_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
