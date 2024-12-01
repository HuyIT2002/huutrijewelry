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
        Schema::create('gold_prices', function (Blueprint $table) {
            $table->increments('gold_prices_id');
            $table->string('mua_vao');
            $table->string('ban_ra');
            $table->string('don_vi');
            $table->boolean('status')->nullable(); // Mô tả role (tùy chọn)
            $table->string('type')->nullable(); // Loại vàng (VD: SJC, PNJ)
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gold_prices');
    }
};
