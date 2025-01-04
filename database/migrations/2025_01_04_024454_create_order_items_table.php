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
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('order_item_id');
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->decimal('price', 15, 2); // Giá của sản phẩm
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng
            $table->string('code_id')->unique(); // Mã đơn hàng (code_id)
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('products_id');
            $table->unsignedInteger('size_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('products_id')->references('products_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
