@extends('admin.home.home_admin')
@section('content')
<style>
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 16px;
        padding: 10px 20px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-lg {
        padding: 12px 24px;
    }
</style>
<section class="panel">
    <header class="panel-heading">
        Thêm mới sản phẩm
    </header>
    <div class="panel-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Product Name -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên sản phẩm</label>
                <div class="col-sm-6">
                    <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}" required>
                    @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Product Name -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Slug</label>
                <div class="col-sm-6">
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Số Lượng</label>
                <div class="col-sm-6">
                    <input type="text" name="so_luong" id="so_luong" class="form-control" value="{{ old('so_luong') }}" required>
                    @error('so_luong')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Product Code ID -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mã sản phẩm</label>
                <div class="col-sm-6">
                    <input type="text" id="code_id" name="code_id" class="form-control" value="{{ old('code_id') }}" required>
                    @error('code_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <!-- Stylish button -->
                    <button type="button" class="btn btn-primary btn-lg" onclick="generateRandomCode()">Tạo Mã Ngẫu Nhiên</button>
                </div>
            </div>
            <!-- Price -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Giá</label>
                <div class="col-sm-6">
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    @error('price')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Weight (Trọng lượng) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Trọng lượng</label>
                <div class="col-sm-6">
                    <input type="text" name="trong_luong" class="form-control" value="{{ old('trong_luong') }}" required>
                    @error('trong_luong')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Material (Hàm chất liệu) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Hàm chất liệu</label>
                <div class="col-sm-6">
                    <input type="text" name="ham_chat_lieu" class="form-control" value="{{ old('ham_chat_lieu') }}" required>
                    @error('ham_chat_lieu')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Main Stone Type (Loại đá chính) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Loại đá chính</label>
                <div class="col-sm-6">
                    <input type="text" name="loai_da_chinh" class="form-control" value="{{ old('loai_da_chinh') }}" required>
                    @error('loai_da_chinh')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Stone Size (Kích thước đá) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Kích thước đá</label>
                <div class="col-sm-6">
                    <input type="text" name="kich_thuoc_da" class="form-control" value="{{ old('kich_thuoc_da') }}" required>
                    @error('kich_thuoc_da')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Main Stone Color (Màu đá chính) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Màu đá chính</label>
                <div class="col-sm-6">
                    <input type="text" name="mau_da_chinh" class="form-control" value="{{ old('mau_da_chinh') }}" required>
                    @error('mau_da_chinh')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Stone Shape (Hình dạng đá) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Hình dạng đá</label>
                <div class="col-sm-6">
                    <input type="text" name="hinh_dang_da" class="form-control" value="{{ old('hinh_dang_da') }}" required>
                    @error('hinh_dang_da')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Main Stone Quantity (Số lượng đá chính) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Số lượng đá chính</label>
                <div class="col-sm-6">
                    <input type="number" name="sl_da_chinh" class="form-control" value="{{ old('sl_da_chinh') }}" required>
                    @error('sl_da_chinh')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Additional Stone Quantity (Số lượng đá phụ) -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Số lượng đá phụ</label>
                <div class="col-sm-6">
                    <input type="number" name="sl_da_phu" class="form-control" value="{{ old('sl_da_phu') }}" required>
                    @error('sl_da_phu')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-lg-6">
                    <select name="status" class="form-control m-bot15" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hiển thị</option>
                    </select>
                </div>
            </div>

            <!-- Trường Chọn danh mục cha -->
            <div class="form-group row d-flex align-items-center">
                <label class="col-sm-3 control-label">Danh mục con</label>
                <div class="col-sm-6">
                    <select name="category_id" class="form-control" required>
                        <option value="">Chọn danh mục sản phẩm</option>
                        @foreach ($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->parent_categorie_id }}">
                            {{ $parentCategory->name }}
                        </option>
                        @foreach ($parentCategory->categories as $category)
                        <option value="{{ $category->category_id }}" style="padding-left: 20px;">
                            -- {{ $category->category_name }}
                        </option>
                        @endforeach
                        @endforeach
                    </select>

                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Trường Mô tả -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mô tả</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Ảnh bài viết</label>
                <div class="col-sm-6">
                    <input type="file" name="images" class="form-control" accept="image/*" onchange="previewImage(event)">
                    @error('images')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="imagePreview" src="#" alt="Ảnh bài viết" style="max-width: 200px; display: none;" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('imagePreview');
                    output.src = reader.result;
                    output.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
        <script>
            function generateRandomCode() {
                var length = 8; // You can change the length as per your requirements
                var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                var randomCode = '';

                for (var i = 0; i < length; i++) {
                    var randomIndex = Math.floor(Math.random() * charset.length);
                    randomCode += charset[randomIndex];
                }

                // Set the generated code into the 'code_id' input field
                document.getElementById('code_id').value = randomCode;
            }
        </script>
        <script>
            document.getElementById('product_name').addEventListener('input', function() {
                var name = this.value;

                // Hàm chuyển đổi các ký tự có dấu thành không dấu
                var slug = convertToSlug(name);

                // Gán giá trị vào ô input slug
                document.getElementById('slug').value = slug;
            });

            // Hàm chuyển đổi tên thành slug
            // Hàm chuyển đổi tên thành slug
            function convertToSlug(text) {
                return text
                    .toLowerCase() // Chuyển thành chữ thường
                    .replace(/đ/g, 'd') // Thay thế ký tự "đ" thành "d"
                    .replace(/Đ/g, 'd') // Thay thế ký tự "Đ" thành "d"
                    .normalize("NFD") // Phân tách ký tự có dấu thành 2 phần (chữ + dấu)
                    .replace(/[\u0300-\u036f]/g, "") // Loại bỏ các dấu (dấu tiếng Việt)
                    .replace(/[^a-z0-9\s-]/g, '') // Loại bỏ các ký tự không phải chữ cái, số, khoảng trắng hoặc dấu gạch ngang
                    .replace(/\s+/g, '-') // Thay khoảng trắng bằng dấu gạch ngang
                    .replace(/-+/g, '-'); // Xóa các dấu gạch ngang dư thừa
            }
        </script>


    </div>
</section>


@endsection