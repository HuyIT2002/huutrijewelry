@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Thêm mới danh mục sản phẩm cha
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


        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.parent-categories.store') }}">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên danh mục cha</label>
                <div class="col-sm-6">
                    <input type="text" id="categoryName" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Slug (đường dẫn thân thiện)</label>
                <div class="col-sm-6">
                    <input type="text" id="categorySlug" name="slug" class="form-control" value="{{ old('slug') }}" required>
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-lg-6">
                    <select name="status" class="form-control m-bot15" required>
                        <option value="Hiển thị" {{ old('status') == 'Hiển thị' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="Không hiển thị" {{ old('status') == 'Không hiển thị' ? 'selected' : '' }}>Không hiển thị</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                    <a href="{{ route('admin.parent-categories.index') }}" class="btn btn-default">Quay lại</a>
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