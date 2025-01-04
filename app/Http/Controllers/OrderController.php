<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Log;

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

    // public function addToCart(Request $request)
    // {
    //     // Log dữ liệu request để kiểm tra
    //     Log::debug('Request data:', $request->all());

    //     // Kiểm tra xem sản phẩm có tồn tại không
    //     $product = Product::find($request->products_id);

    //     if (!$product || $product->so_luong <= 0) {
    //         return back()->with('error', 'Sản phẩm hết hàng!');
    //     }

    //     // Kiểm tra xem size có được chọn hay không
    //     $size_id = $request->size; // size được gửi từ form
    //     if (!$size_id) {
    //         return back()->with('error', 'Vui lòng chọn kích thước!');
    //     }

    //     Log::debug('Size ID received:', ['size_id' => $size_id]);

    //     // Truy vấn bảng Size để lấy tên size tương ứng với size_id
    //     $size = Size::find($size_id);

    //     // Kiểm tra nếu size không hợp lệ
    //     if (!$size) {
    //         Log::debug('Size not found for ID:', ['size_id' => $size_id]);
    //         return back()->with('error', 'Size không hợp lệ!');
    //     }

    //     Log::debug('Size found:', ['size' => $size->size]);

    //     // Lấy giỏ hàng từ session
    //     $cart = session()->get('cart', []);

    //     // Nếu sản phẩm đã có trong giỏ, tăng số lượng
    //     if (isset($cart[$request->products_id])) {
    //         $cart[$request->products_id]['quantity']++;
    //     } else {
    //         // Nếu sản phẩm chưa có, thêm mới vào giỏ
    //         $cart[$request->products_id] = [
    //             'product_name' => $product->product_name ?: 'Tên sản phẩm không có',
    //             'price' => $product->price ?: 0,
    //             'products_id' => $product->products_id,
    //             'size' => $size->size,  // Lưu tên size
    //             'size_id' => $size->size_id,  // Lưu size_id
    //             'code_id' => $product->code_id ?: 'Không có mã sản phẩm',
    //             'trong_luong' => $product->trong_luong ?: 'Không có trọng lượng',
    //             'quantity' => 1,
    //             'image' => $product->images ?: 'default.jpg',
    //         ];
    //     }

    //     // Lưu giỏ hàng vào session
    //     session()->put('cart', $cart);

    //     // Log giỏ hàng sau khi cập nhật
    //     Log::debug('Cart after update:', ['cart' => session()->get('cart')]);

    //     // Chuyển hướng đến trang giỏ hàng với thông báo thành công
    //     return redirect()->route('user.orders.list')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    // }

    public function addToCart(Request $request)
    {
        // Log dữ liệu request để kiểm tra
        Log::debug('Request data:', $request->all());

        // Kiểm tra xem sản phẩm có tồn tại không
        $product = Product::find($request->products_id);

        if (!$product || $product->so_luong <= 0) {
            return back()->with('error', 'Sản phẩm hết hàng!');
        }

        // Kiểm tra xem size có được chọn hay không
        $size_id = $request->size; // size được gửi từ form
        if ($size_id) {
            // Truy vấn bảng Size để lấy tên size tương ứng với size_id
            $size = Size::find($size_id);

            // Kiểm tra nếu size không hợp lệ
            if (!$size) {
                Log::debug('Size not found for ID:', ['size_id' => $size_id]);
                return back()->with('error', 'Size không hợp lệ!');
            }

            Log::debug('Size found:', ['size' => $size->size]);
        } else {
            // Nếu không có size được chọn, đặt giá trị size = 0 và size_id = 0
            $size = null;
            $size_id = 0;  // Đặt giá trị size_id bằng 0 để tránh lỗi khi không có size
            Log::debug('No size selected, setting size_id to 0.');
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu sản phẩm đã có trong giỏ và cập nhật số lượng
        if (isset($cart[$request->products_id])) {
            // Cập nhật số lượng sản phẩm từ request
            $cart[$request->products_id]['quantity'] = $request->quantity;  // Sử dụng số lượng từ request
        } else {
            // Nếu sản phẩm chưa có trong giỏ, thêm mới vào giỏ
            $cart[$request->products_id] = [
                'product_name' => $product->product_name ?: 'Tên sản phẩm không có',
                'price' => $product->price ?: 0,
                'products_id' => $product->products_id,
                'size' => $size ? $size->size : 'Không có size',  // Lưu tên size, nếu không có thì "Không có size"
                'size_id' => $size_id,  // Lưu size_id, nếu không có thì 0
                'code_id' => $product->code_id ?: 'Không có mã sản phẩm',
                'trong_luong' => $product->trong_luong ?: 'Không có trọng lượng',
                'quantity' => $request->quantity, // Lưu số lượng từ request
                'image' => $product->images ?: 'default.jpg',
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Log giỏ hàng sau khi cập nhật
        Log::debug('Cart after update:', ['cart' => session()->get('cart')]);

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
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra xem 'cart' có dữ liệu không
        if ($request->has('cart') && is_array($request->input('cart'))) {
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            foreach ($request->input('cart') as $productId => $item) {
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $item['quantity']; // Cập nhật số lượng
                }
            }

            // Lưu lại giỏ hàng mới vào session
            session()->put('cart', $cart);
        }

        return redirect()->route('user.orders.list')->with('success', 'Giỏ hàng đã được cập nhật!');
    }
}
