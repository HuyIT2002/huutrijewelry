<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoldPrice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GoldPriceController extends Controller
{
    public function index()
    {
        $goldPrices = GoldPrice::all();
        return view('admin.goldPrice.gold_price', compact('goldPrices'));
    }
    public function create()
    {
        return view('admin.goldPrice.create'); // trả về view thêm mới
    }
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'mua_vao' => 'required|numeric|min:0',
            'ban_ra' => 'required|numeric|min:0',
            'don_vi' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:Hiển thị,Không hiển thị',
        ]);

        // Lưu dữ liệu vào database
        GoldPrice::create([
            'mua_vao' => $request->mua_vao,
            'ban_ra' => $request->ban_ra,
            'don_vi' => $request->don_vi,
            'type' => $request->type,
            'status' => $request->status === 'Hiển thị' ? 1 : 0, // 1: Hiển thị, 0: Không hiển thị
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Chuyển hướng về trang danh sách hoặc thông báo thành công
        return redirect()->route('admin.gold-prices.create')->with('success', 'Thêm mới giá vàng thành công!');
    }
    public function edit($gold_prices_id)
    {
        $goldPrice = GoldPrice::findOrFail($gold_prices_id); // Tìm bản ghi hoặc báo lỗi 404
        return view('admin.goldPrice.edit', compact('goldPrice'));
    }
    public function update(Request $request, $gold_prices_id)
    {
        $validated = $request->validate([
            'mua_vao' => 'required|string|max:255',
            'ban_ra' => 'required|string|max:255',
            'don_vi' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|in:Hiển thị,Không hiển thị',
        ]);

        $status = $validated['status'] === 'Hiển thị' ? 1 : 0; // Chuyển đổi thành số

        // Cập nhật dữ liệu vào cơ sở dữ liệu
        $goldPrice = GoldPrice::find($gold_prices_id);
        $goldPrice->update([
            'mua_vao' => $validated['mua_vao'],
            'ban_ra' => $validated['ban_ra'],
            'don_vi' => $validated['don_vi'],
            'type' => $validated['type'],
            'status' => $status, // Lưu giá trị số
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        return redirect()->route('admin.gold-prices.index')->with('success', 'Cập nhật giá vàng thành công.');
    }
    public function destroy($gold_prices_id)
    {
        $goldPrice = GoldPrice::find($gold_prices_id);

        if ($goldPrice) {
            $goldPrice->delete();
            return redirect()->route('admin.gold-prices.index')->with('success', 'Xóa giá vàng thành công.');
        }

        return redirect()->route('admin.gold-prices.index')->withErrors(['Không tìm thấy giá vàng để xóa.']);
    }
    public function updateStatus($gold_prices_id)
    {
        // Tìm bản ghi theo ID
        $price = GoldPrice::findOrFail($gold_prices_id);

        // Đổi trạng thái (Hiển thị/Không hiển thị)
        $price->status = $price->status == 1 ? 0 : 1; // Nếu status là 1 thì chuyển thành 0, ngược lại
        $price->save(); // Lưu thay đổi

        // Chuyển hướng về trang danh sách và thông báo thành công
        return redirect()->route('admin.gold-prices.index')->with('success', 'Trạng thái đã được cập nhật!');
    }
}
