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
        Schema::create('category_posts', function (Blueprint $table) {
            $table->increments('category_posts_id'); // Khóa chính tự tăng
            $table->string('name')->unique(); // Tên danh mục
            $table->string('slug')->unique(); // Đường dẫn thân thiện
            $table->text('description')->nullable(); // Mô tả (tùy c
            $table->boolean('status')->default(true); // Trạng thái (Hiển thị hoặc Ẩn)
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng
            $table->unsignedInteger('category_posts_id'); // Cột khóa ngoại trỏ đến bảng category_posts
            $table->foreign('category_posts_id') // Xác định mối quan hệ
                ->references('category_posts_id') // Trỏ đến cột category_posts_id trong bảng category_posts
                ->on('category_posts') // Tên bảng category_posts
                ->onDelete('cascade'); // Tự động xóa các bài viết khi danh mục bị xóa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_posts');
    }
};
