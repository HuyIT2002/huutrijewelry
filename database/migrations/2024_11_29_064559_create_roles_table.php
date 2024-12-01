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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('roles_id');
            $table->string('name'); // Tên role
            $table->integer('type'); // Tquyền
            $table->text('description')->nullable(); // Mô tả role (tùy chọn)
            $table->boolean('status')->nullable(); // Mô tả role (tùy chọn)
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
        Schema::dropIfExists('roles');
    }
};
