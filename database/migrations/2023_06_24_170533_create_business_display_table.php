<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessDisplayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_displays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vi_name');
            $table->string('en_name');
            $table->string('slug');
            $table->unsignedInteger('business_category_id');
            $table->string('image')->nullable();
            // Thêm các cột khác của bảng nếu cần
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
        Schema::dropIfExists('business_display');
    }
}
