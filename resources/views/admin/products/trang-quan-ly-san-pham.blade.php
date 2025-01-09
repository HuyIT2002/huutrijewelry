@extends('admin.home.home_admin')

@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $pageTitle }} <!-- Hiển thị tiêu đề trang -->
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                    Thêm mới sản phẩm
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th>Trọng lượng</th>
                        <th>Hàm chất liệu</th>
                        <th>Loại đá chính</th>
                        <th>Kích thước đá</th>
                        <th>Màu đá chính</th>
                        <th>Hình dạng đá</th>
                        <th>Số lượng đá chính</th>
                        <th>Số lượng đá phụ</th>
                        <th>Mô tả</th>
                        <th>Danh mục cha</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian sửa</th>
                        <th>Lựa chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td><a href="#" data-toggle="modal" data-target="#productDetailModal" data-id="{{ $product->products_id }}"
                                data-product-name="{{ $product->product_name }}"
                                data-code-id="{{ $product->code_id }}" data-price="{{ $product->price }}" data-so-luong="{{ $product->so_luong }}"
                                data-image="{{ asset('public/admin/images/products/' . $product->images) }}"
                                data-trong-luong="{{ $product->trong_luong }}" data-ham-chat-lieu="{{ $product->ham_chat_lieu }}" data-loai-da-chinh="{{ $product->loai_da_chinh }}" data-kich-thuoc-da="{{ $product->kich_thuoc_da }}" data-mau-da-chinh="{{ $product->mau_da_chinh }}" data-hinh-dang-da="{{ $product->hinh_dang_da }}" data-sl-da-chinh="{{ $product->sl_da_chinh }}" data-sl-da-phu="{{ $product->sl_da_phu }}" data-description="{{ $product->description }}"
                                data-parent-category="{{ $product->category ? $product->category->category_name : 'Không có' }}" data-created-at="{{ $product->created_at }}" data-updated-at="{{ $product->updated_at }}">
                                {{ $product->products_id }}</a>
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->code_id }}</td>
                        <td>{{ is_numeric($product->price) ? number_format($product->price, 0, ',', '.') . ' VNĐ' : 'N/A' }}</td>
                        <td>{{ $product->so_luong }}</td>
                        <td>
                            <a href="{{ route('admin.products.update-status', $product->products_id) }}" class="btn btn-sm {{ $product->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $product->status == 1 ? 'Mở' : 'Đóng' }}
                            </a>
                        </td>
                        <td>
                            <!-- Hiển thị ảnh nếu có -->
                            @if ($product->images)
                            <img src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                            @else
                            Không có ảnh
                            @endif
                        </td>

                        <td>{{ $product->trong_luong }}</td>
                        <td>{{ $product->ham_chat_lieu }}</td>
                        <td>{{ $product->loai_da_chinh }}</td>
                        <td>{{ $product->kich_thuoc_da }}</td>
                        <td>{{ $product->mau_da_chinh }}</td>
                        <td>{{ $product->hinh_dang_da }}</td>
                        <td>{{ $product->sl_da_chinh }}</td>
                        <td>{{ $product->sl_da_phu }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category ? $product->category->category_name : 'Không có' }}</td>
                        </td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->products_id) }}" class="btn btn-sm btn-info">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product->products_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer-2">
            <div class="row-2">
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <!-- Nút Previous -->
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Hiển thị các số trang -->
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        <!-- Nút Next -->
                        <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>
</div>

<!-- Modal for Product Details -->
<div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Chi tiết sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Tên sản phẩm:</strong> <span id="modal-product-name"></span></p>
                <p><strong>Mã sản phẩm:</strong> <span id="modal-code-id"></span></p>
                <p><strong>Giá:</strong> <span id="modal-price"></span></p>
                <p><strong>Số lượng:</strong> <span id="modal-so-luong"></span></p>
                <p><strong>Trọng lượng:</strong> <span id="modal-trong-luong"></span></p>
                <p><strong>Hàm chất liệu:</strong> <span id="modal-ham-chat-lieu"></span></p>
                <p><strong>Loại đá chính:</strong> <span id="modal-loai-da-chinh"></span></p>
                <p><strong>Kích thước đá:</strong> <span id="modal-kich-thuoc-da"></span></p>
                <p><strong>Màu đá chính:</strong> <span id="modal-mau-da-chinh"></span></p>
                <p><strong>Hình dạng đá:</strong> <span id="modal-hinh-dang-da"></span></p>
                <p><strong>Số lượng đá chính:</strong> <span id="modal-sl-da-chinh"></span></p>
                <p><strong>Số lượng đá phụ:</strong> <span id="modal-sl-da-phu"></span></p>
                <p><strong>Mô tả:</strong> <span id="modal-description"></span></p>
                <p><strong>Danh mục cha:</strong> <span id="modal-parent-category"></span></p>
                <p><strong>Thời gian tạo:</strong> <span id="modal-created-at"></span></p>
                <p><strong>Thời gian sửa:</strong> <span id="modal-updated-at"></span></p>
                <div class="form-group">
                    <img id="postImage" style="max-width: 30%; height: auto;" alt="Image">
                </div>

            </div>
            <div class="modal-footer">
                <a href="" id="modal-edit-btn" class="btn btn-sm btn-info">Sửa</a>
                <form id="modal-delete-form" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#productDetailModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Lấy đối tượng đã kích hoạt modal
        var image = button.data('image'); // Đảm bảo lấy đúng dữ liệu ảnh
        var productId = button.data('id');
        console.log('Image Path:', image); // Kiểm tra đường dẫn ảnh trong console

        // Cập nhật thông tin trong modal
        $('#modal-product-name').text(button.data('product-name'));
        $('#modal-code-id').text(button.data('code-id'));
        $('#modal-price').text(button.data('price'));
        $('#modal-so-luong').text(button.data('so-luong'));
        $('#modal-trong-luong').text(button.data('trong-luong'));
        $('#modal-ham-chat-lieu').text(button.data('ham-chat-lieu'));
        $('#modal-loai-da-chinh').text(button.data('loai-da-chinh'));
        $('#modal-kich-thuoc-da').text(button.data('kich-thuoc-da'));
        $('#modal-mau-da-chinh').text(button.data('mau-da-chinh'));
        $('#modal-hinh-dang-da').text(button.data('hinh-dang-da'));
        $('#modal-sl-da-chinh').text(button.data('sl-da-chinh'));
        $('#modal-sl-da-phu').text(button.data('sl-da-phu'));
        $('#modal-description').text(button.data('description'));
        $('#modal-parent-category').text(button.data('parent-category'));
        $('#modal-created-at').text(button.data('created-at'));
        $('#modal-updated-at').text(button.data('updated-at'));

        // Cập nhật đường dẫn ảnh trong modal
        $('#postImage').attr('src', image); // Đảm bảo đường dẫn ảnh đúng
        var editUrl = "{{ route('admin.products.edit', ':id') }}".replace(':id', productId);
        $('#modal-edit-btn').attr('href', editUrl);

        // Cập nhật URL cho form Xóa
        var deleteUrl = "{{ route('admin.products.destroy', ':id') }}".replace(':id', productId);
        $('#modal-delete-form').attr('action', deleteUrl);
    });
</script>
@endsection