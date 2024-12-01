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
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('admin_id'); // Auto increment ID
            $table->string('username')->unique(); // Tên đăng nhập
            $table->string('password'); // Mật khẩu
            $table->string('email')->unique(); // Địa chỉ email
            $table->integer('role_id')->unsigned(); // Role ID (liên kết với bảng roles)
            $table->boolean('status')->default(1); // Trạng thái tài khoản (1 - Active, 0 - Inactive)
            $table->string('admin_image'); // Mật khẩu
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng

            // Thêm khóa ngoại liên kết với bảng roles
            $table->foreign('role_id')->references('roles_id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
