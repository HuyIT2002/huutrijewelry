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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id'); // Khóa chính tự tăng
            $table->unsignedInteger('parent_categorie_id')->nullable(); // Liên kết tới bảng parent_categories
            $table->string('category_name'); // Tên danh mục (không có unique)
            $table->string('slug'); // Đường dẫn thân thiện (không có unique)
            $table->text('description')->nullable(); // Mô tả
            $table->boolean('status')->default(true); // Trạng thái (Hiển thị hoặc Ẩn)
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng

            // Khóa ngoại liên kết với bảng parent_categories
            $table->foreign('parent_categorie_id')
                ->references('parent_categorie_id') // Đảm bảo trường này tồn tại trong bảng parent_categories
                ->on('parent_categories')
                ->onDelete('set null'); // Khi danh mục cha bị xóa, giá trị được đặt NULL
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
