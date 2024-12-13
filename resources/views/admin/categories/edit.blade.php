@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Chỉnh sửa danh mục sản phẩm con
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


        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.categories.update', $category->category_id) }}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên danh mục con</label>
                <div class="col-sm-6">
                    <input type="text" id="categoryName" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}" required>
                    @error('category_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Slug (đường dẫn thân thiện)</label>
                <div class="col-sm-6">
                    <input type="text" id="categorySlug" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-lg-6">
                    <select name="status" class="form-control m-bot15" required>
                        <option value="Hiển thị" {{ old('status', $category->status ? 'Hiển thị' : 'Không hiển thị') == 'Hiển thị' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="Không hiển thị" {{ old('status', $category->status ? 'Hiển thị' : 'Không hiển thị') == 'Không hiển thị' ? 'selected' : '' }}>Không hiển thị</option>
                    </select>
                </div>
            </div>
            <!-- Trường Chọn danh mục cha -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Danh mục cha</label>
                <div class="col-sm-6">
                    <select name="parent_categorie_id" class="form-control">
                        <option value="">Chọn danh mục cha</option>
                        @foreach ($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->parent_categorie_id }}"
                            {{ old('parent_categorie_id', $category->parent_categorie_id) == $parentCategory->parent_categorie_id ? 'selected' : '' }}>
                            {{ $parentCategory->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('parent_categorie_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Trường Mô tả -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mô tả</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>

        <script>
            document.getElementById('categoryName').addEventListener('input', function() {
                var name = this.value;

                // Hàm chuyển đổi các ký tự có dấu thành không dấu
                var slug = convertToSlug(name);

                // Gán giá trị vào ô input slug
                document.getElementById('categorySlug').value = slug;
            });

            // Hàm chuyển đổi tên thành slug
            function convertToSlug(text) {
                return text
                    .toLowerCase() // Chuyển thành chữ thường
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