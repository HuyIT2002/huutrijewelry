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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');  // Tạo khóa chính `member_id`
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('address');
            $table->boolean('status')->default(true);
            $table->string('images'); // Ảnh sản phẩm
            $table->unsignedInteger('role_id');
            $table->dateTime('created_at')->nullable(); // Cột created_at riêng
            $table->dateTime('updated_at')->nullable(); // Cột updated_at riêng
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
