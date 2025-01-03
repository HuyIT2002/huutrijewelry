<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CategoryService;

class OrderController extends Controller
{
    protected $categoryService;

    // Inject CategoryService vào controller
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        // Lấy giỏ hàng từ session
        $data = $this->categoryService->getAllCategoriesData();
        $cart = session()->get('cart', []);
        $total = 0;

        // Kiểm tra giỏ hàng có trống không
        if (empty($cart)) {
            session()->forget('cart'); // Xóa giỏ hàng nếu trống
            // Đảm bảo $data có $parentCategories ngay cả khi giỏ hàng trống
            if (!isset($data['parentCategories'])) {
                $data['parentCategories'] = []; // Hoặc một giá trị mặc định nếu không có
            }
            return view('user.orders.list-order', array_merge($data, ['message' => 'Giỏ hàng của bạn trống!']));
        }

        // Tính tổng giá trị giỏ hàng
        foreach ($cart as $item) {
            if (isset($item['price']) && isset($item['quantity'])) { // Kiểm tra 'price' và 'quantity'
                $total += $item['price'] * $item['quantity'];
            }
        }

        // Hợp nhất tất cả dữ liệu vào trong mảng và trả về view
        return view('user.orders.list-order', array_merge($data, compact('cart', 'total')));
    }


    public function addToCart(Request $request)
    {
        // Kiểm tra xem sản phẩm có tồn tại không
        $product = Product::find($request->products_id);

        if (!$product || $product->so_luong <= 0) {
            return back()->with('error', 'Sản phẩm hết hàng!');
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có trong giỏ, tăng số lượng
        if (isset($cart[$request->products_id])) {
            $cart[$request->products_id]['quantity']++;
        } else {
            // Nếu sản phẩm chưa có, thêm mới vào giỏ
            $cart[$request->products_id] = [
                'product_name' => $product->product_name ?: 'Tên sản phẩm không có',  // Đảm bảo có tên sản phẩm
                'price' => $product->price ?: 0,  // Đảm bảo có giá sản phẩm
                'code_id' => $product->code_id ?: 'Không có mã sản phẩm',  // Đảm bảo có mã sản phẩm
                'trong_luong' => $product->trong_luong ?: 'Không có trọng lượng',  // Đảm bảo có trọng lượng
                'quantity' => 1,
                'image' => $product->images ?: 'default.jpg',  // Đảm bảo có ảnh sản phẩm
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Chuyển hướng đến trang giỏ hàng với thông báo thành công
        return redirect()->route('user.orders.list')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId)
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ hàng
        }

        // Kiểm tra nếu giỏ hàng trống, xóa giỏ hàng trong session
        if (empty($cart)) {
            session()->forget('cart'); // Xóa toàn bộ giỏ hàng nếu trống
        } else {
            // Lưu giỏ hàng đã được cập nhật
            session()->put('cart', $cart);
        }

        // Quay lại trang cũ với thông báo thành công
        return back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
    // Tạo đơn hàng từ giỏ hàng
    public function create(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!session('member_id')) {
            return redirect()->route('user.member.login.form')->with('message', 'Vui lòng đăng nhập để tiếp tục.');
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart');
        if (!$cart) {
            return back()->with('error', 'Giỏ hàng của bạn trống!');
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'member_id' => session('member_id'),
            'code_id' => uniqid(), // Mã đơn hàng ngẫu nhiên
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_email' => $request->receiver_email,
            'shipping_address' => $request->shipping_address,
            'total_price' => array_sum(array_column($cart, 'price')), // Tổng tiền của đơn hàng
            'status' => 'pending',
        ]);

        // Thêm các sản phẩm vào đơn hàng
        foreach ($cart as $productId => $product) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $productId,
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        // Xóa giỏ hàng trong session
        session()->forget('cart');

        return redirect()->route('user.orders.create')->with('success', 'Đơn hàng đã được tạo thành công!');
    }
}
