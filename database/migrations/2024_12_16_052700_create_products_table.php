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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('products_id'); // Khóa chính
            $table->string('product_name'); // Tên sản phẩm
            $table->string(column: 'slug'); // Tên sản phẩm
            $table->integer(column: 'so_luong'); // Tên sản phẩm
            $table->string('images'); // Ảnh sản phẩm
            $table->string('code_id'); // Mã sản phẩm
            $table->string('price'); // Giá sản phẩm
            $table->string('trong_luong'); // Trọng lượng
            $table->string('ham_chat_lieu'); // Hàm chất liệu
            $table->string('loai_da_chinh')->nullable(); // Loại đá chính (nullable)
            $table->string('kich_thuoc_da')->nullable(); // Kích thước đá (nullable)
            $table->string('mau_da_chinh')->nullable(); // Màu đá chính (nullable)
            $table->string('hinh_dang_da')->nullable(); // Hình dạng đá (nullable)
            $table->string('sl_da_chinh')->nullable(); // Số lượng đá chính (nullable)
            $table->string('sl_da_phu')->nullable(); // Số lượng đá phụ (nullable)
            $table->text('description')->nullable(); // Mô tả
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng
            $table->boolean('status')->default(true);
            $table->unsignedInteger('category_id')->nullable(); // FK đến bảng parent_categories
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gold_products');
    }
};
