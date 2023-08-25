<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitAndImportPriceToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('unit')->nullable()->after('price'); // Đổi kiểu dữ liệu nếu cần thiết
            $table->integer('import_price')->nullable()->after('price');

        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('unit');
            $table->dropColumn('import_price');
        });
    }
}
