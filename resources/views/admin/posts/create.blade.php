@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Thêm mới bài viết
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

        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Tiêu đề bài viết</label>
                <div class="col-sm-6">
                    <input type="text" id="postTitle" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Slug (đường dẫn thân thiện)</label>
                <div class="col-sm-6">
                    <input type="text" id="postSlug" name="slug" class="form-control" value="{{ old('slug') }}" required>
                    @error('slug')
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

            <!-- Mô tả -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mô tả</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Trường Chọn danh mục bài viết -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Danh mục bài viết</label>
                <div class="col-sm-6">
                    <select name="category_posts_id" class="form-control">
                        <option value="">Chọn danh mục bài viết</option>
                        @foreach ($categoryPost as $categoryPosts)
                        <option value="{{ $categoryPosts->category_posts_id }}"
                            {{ old('category_posts_id') == $categoryPosts->category_posts_id ? 'selected' : '' }}>
                            {{ $categoryPosts->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_posts_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Content editor -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Nội dung</label>
                <div class="col-sm-6">
                    <textarea name="content" class="form-control" id="contentEditor" rows="10">{{ old('content') }}</textarea>
                    @error('content')
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

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>

        <script>
            document.getElementById('postTitle').addEventListener('input', function() {
                var name = this.value;

                // Hàm chuyển đổi các ký tự có dấu thành không dấu
                var slug = convertToSlug(name);

                // Gán giá trị vào ô input slug
                document.getElementById('postSlug').value = slug;
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

        <!-- Include CKEditor script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#contentEditor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    </div>
</section>

@endsection