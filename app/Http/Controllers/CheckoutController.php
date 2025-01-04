<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    //
    protected $categoryService;

    // Inject CategoryService vào controller
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }



    public function index()
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        $user = session()->get('member_id') ? (object) session()->all() : null;
        // Tính toán tổng tiền cần thanh toán
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Lấy các dữ liệu cần thiết cho page checkout
        $data = $this->categoryService->getAllCategoriesData();
        $data['cart'] = $cart;
        $data['total'] = $total;
        $data['user'] = $user;

        return view('user.checkout.thanh-toan', $data);
    }



    // public function processCheckout(Request $request)
    // {
    //     try {
    //         // Validate dữ liệu form
    //         $validated = $request->validate([
    //             'full_name' => 'required|string|max:255',
    //             'email' => 'required|email|max:255',
    //             'phone' => 'nullable|string|max:15',
    //             'address' => 'nullable|string|max:255',
    //             'ordernote' => 'nullable|string',
    //             'paymentmethod' => 'required|in:0,1', // Chỉ chấp nhận 0 hoặc 1
    //             'cart' => 'required|array|min:1', // Giỏ hàng phải là mảng và không được rỗng
    //             'cart.*.product_name' => 'required|string|max:255',
    //             'cart.*.quantity' => 'required|integer|min:1',
    //             'cart.*.price' => 'required|numeric|min:0',
    //             'cart.*.code_id' => 'required|string|max:50',
    //             'cart.*.products_id' => 'required|integer',
    //             'cart.*.size' => 'nullable|string',
    //             'cart.*.size_id' => 'nullable|integer',
    //             'cart.*.trong_luong' => 'nullable|string',
    //             'cart.*.image' => 'nullable|string',
    //         ]);

    //         Log::info('Dữ liệu đã được xác thực', ['validated_data' => $validated]);

    //         // Ghi log chi tiết giỏ hàng trước khi lưu
    //         Log::debug('Giỏ hàng:', ['cart' => array_map(function ($item) {
    //             return [
    //                 'product_name' => $item['product_name'],
    //                 'quantity' => $item['quantity'],
    //                 'price' => $item['price'],
    //             ];
    //         }, $validated['cart'])]);

    //         // Tính tổng giá đơn hàng
    //         $totalPrice = array_sum(array_map(function ($item) {
    //             return $item['quantity'] * $item['price'];
    //         }, $validated['cart']));

    //         // Kiểm tra nếu paymentmethod không có, gán giá trị mặc định là 0
    //         $paymentMethod = $validated['paymentmethod'] ?? 0;
    //         $memberId = session('member_id');

    //         if (!$memberId) {
    //             return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện đơn hàng.');
    //         }
    //         // Lưu thông tin đơn hàng
    //         $order = Order::create([
    //             'member_id' => $memberId,
    //             'receiver_name' => $validated['full_name'],
    //             'receiver_email' => $validated['email'],
    //             'receiver_phone' => $validated['phone'],
    //             'shipping_address' => $validated['address'],
    //             'total_price' => $totalPrice,
    //             'status' => 0, // 0: Đơn hàng mới, chưa xử lý
    //             'paymentmethod' => $paymentMethod, // Đảm bảo có giá trị hợp lệ cho status_payment
    //             'created_at' => now(),
    //         ]);

    //         Log::info('Đơn hàng đã được lưu', ['order_id' => $order->order_id]);

    //         // Lưu các sản phẩm trong giỏ hàng vào bảng order_items
    //         foreach ($validated['cart'] as $cartItem) {
    //             $sizeId = ($cartItem['size_id'] == 0) ? null : $cartItem['size_id'];
    //             OrderItem::create([
    //                 'order_id' => $order->order_id,  // Đảm bảo 'order_id' là ID của đơn hàng đã tạo
    //                 'product_name' => $cartItem['product_name'],
    //                 'quantity' => $cartItem['quantity'],
    //                 'price' => $cartItem['price'],
    //                 'code_id' => $cartItem['code_id'],
    //                 'products_id' => $cartItem['products_id'] ?? null, // Nếu không có, gán giá trị mặc định null
    //                 'size_id' => $sizeId,
    //                 'image' => $cartItem['image'] ?? null,
    //                 'created_at' => now(),
    //             ]);

    //             Log::info('Sản phẩm trong giỏ hàng đã được lưu', ['cart_item' => [
    //                 'product_name' => $cartItem['product_name'],
    //                 'quantity' => $cartItem['quantity'],
    //                 'price' => $cartItem['price'],
    //             ]]);
    //         }

    //         Log::info('Hoàn thành xử lý đơn hàng', ['order_id' => $order->order_id]);

    //         // Redirect về trang danh sách đơn hàng của người dùng
    //         return redirect()->route('user.orders.list')->with('success', 'Đơn hàng đã được tạo thành công!');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Ghi log lỗi validate
    //         Log::error('Lỗi validate dữ liệu đơn hàng', [
    //             'errors' => $e->errors(),
    //             'input' => $request->only(['full_name', 'email', 'phone', 'address', 'paymentmethod']),
    //         ]);

    //         return back()->withErrors($e->errors())->withInput();
    //     } catch (\Exception $e) {
    //         // Ghi log lỗi hệ thống
    //         Log::error('Lỗi trong quá trình xử lý đơn hàng', [
    //             'error' => $e->getMessage(),
    //             'stack' => $e->getTraceAsString(),
    //         ]);

    //         return back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình xử lý đơn hàng.']);
    //     }
    // }
    public function processCheckout(Request $request)
    {
        try {
            // Validate dữ liệu form
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
                'ordernote' => 'nullable|string',
                'paymentmethod' => 'required|in:0,1', // Chỉ chấp nhận 0 hoặc 1
                'cart' => 'required|array|min:1', // Giỏ hàng phải là mảng và không được rỗng
                'cart.*.product_name' => 'required|string|max:255',
                'cart.*.quantity' => 'required|integer|min:1',
                'cart.*.price' => 'required|numeric|min:0',
                'cart.*.code_id' => 'required|string|max:50',
                'cart.*.products_id' => 'required|integer',
                'cart.*.size' => 'nullable|string',
                'cart.*.size_id' => 'nullable|integer',
                'cart.*.trong_luong' => 'nullable|string',
                'cart.*.image' => 'nullable|string',
            ]);

            Log::info('Dữ liệu đã được xác thực', ['validated_data' => $validated]);

            // Ghi log chi tiết giỏ hàng trước khi lưu
            Log::debug('Giỏ hàng:', ['cart' => array_map(function ($item) {
                return [
                    'product_name' => $item['product_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }, $validated['cart'])]);

            // Tính tổng giá đơn hàng
            $totalPrice = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $validated['cart']));

            // Kiểm tra nếu paymentmethod không có, gán giá trị mặc định là 0
            $paymentMethod = $validated['paymentmethod'] ?? 0;
            $memberId = session('member_id');

            if (!$memberId) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện đơn hàng.');
            }

            // Lưu thông tin đơn hàng
            $order = Order::create([
                'member_id' => $memberId,
                'receiver_name' => $validated['full_name'],
                'receiver_email' => $validated['email'],
                'receiver_phone' => $validated['phone'],
                'shipping_address' => $validated['address'],
                'total_price' => $totalPrice,
                'status' => 0, // 0: Đơn hàng mới, chưa xử lý
                'paymentmethod' => $paymentMethod, // Đảm bảo có giá trị hợp lệ cho status_payment
                'created_at' => now(),
            ]);

            Log::info('Đơn hàng đã được lưu', ['order_id' => $order->order_id]);

            // Lưu các sản phẩm trong giỏ hàng vào bảng order_items và cập nhật số lượng sản phẩm
            foreach ($validated['cart'] as $cartItem) {
                $sizeId = ($cartItem['size_id'] == 0) ? null : $cartItem['size_id'];

                // Tạo order_item
                $orderItem = OrderItem::create([
                    'order_id' => $order->order_id,  // Đảm bảo 'order_id' là ID của đơn hàng đã tạo
                    'product_name' => $cartItem['product_name'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                    'code_id' => $cartItem['code_id'],
                    'products_id' => $cartItem['products_id'] ?? null, // Nếu không có, gán giá trị mặc định null
                    'size_id' => $sizeId,
                    'created_at' => now(),
                ]);

                // Giảm số lượng sản phẩm trong bảng `products`
                $product = Product::find($cartItem['products_id']);
                if ($product) {
                    $product->decrement('so_luong', $cartItem['quantity']);
                }

                Log::info('Sản phẩm trong giỏ hàng đã được lưu', ['cart_item' => [
                    'product_name' => $cartItem['product_name'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price'],
                ]]);
            }

            Log::info('Hoàn thành xử lý đơn hàng', ['order_id' => $order->order_id]);

            // Xóa session 'user.orders.list' sau khi đơn hàng đã được tạo thành công
            session()->forget('cart');

            // Redirect về trang danh sách đơn hàng của người dùng
            return redirect()->route('user.orders.list')->with('success', 'Đơn hàng đã được tạo thành công!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Ghi log lỗi validate
            Log::error('Lỗi validate dữ liệu đơn hàng', [
                'errors' => $e->errors(),
                'input' => $request->only(['full_name', 'email', 'phone', 'address', 'paymentmethod']),
            ]);

            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Ghi log lỗi hệ thống
            Log::error('Lỗi trong quá trình xử lý đơn hàng', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return back()->withErrors(['error' => 'Có lỗi xảy ra trong quá trình xử lý đơn hàng.']);
        }
    }
}
