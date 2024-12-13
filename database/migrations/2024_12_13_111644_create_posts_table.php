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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('posts_id'); // Khóa chính tự tăng
            $table->string('title'); // Tạo cột title
            $table->text('content'); // Tạo cột content
            $table->string('slug')->unique(); // Tạo cột slug và đảm bảo nó là duy n
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
        Schema::dropIfExists('posts');
    }
};
