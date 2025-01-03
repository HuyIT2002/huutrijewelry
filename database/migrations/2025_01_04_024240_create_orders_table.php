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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id'); // Cột order_id, khóa chính tự động tăng
            $table->unsignedInteger('member_id'); // Cột member_id, khóa ngoại trỏ đến bảng members
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade'); // Liên kết với bảng members, xóa dữ liệu liên quan khi xóa member
            $table->string('code_id')->unique(); // Mã đơn hàng (code_id)
            $table->string('receiver_name'); // Tên người nhận
            $table->string('receiver_phone'); // Số điện thoại người nhận
            $table->string('receiver_email'); // Địa chỉ email người nhận
            $table->text('shipping_address'); // Địa chỉ nhận hàng
            $table->decimal('total_price', 15, 2); // Tổng tiền của đơn hàng
            $table->boolean('status'); // Trạng thái đơn hàng (true/false)
            $table->timestamps(); // Laravel tự động thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
