@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Sửa danh sách size
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

        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.size.update', $size->size_id) }}">
            @csrf
            @method('POST')
            <!-- Tên size -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Size</label>
                <div class="col-sm-6">
                    <input type="text" id="sizeName" name="size" class="form-control"
                        value="{{ old('size', $size->size) }}" required>
                    @error('size')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Trạng thái -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-lg-6">
                    <select name="status" class="form-control m-bot15" required>
                        <option value="1" {{ old('status', $size->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status', $size->status) == 0 ? 'selected' : '' }}>Không hiển thị</option>
                    </select>
                </div>
            </div>
            <!-- Trường Chọn sản phẩm -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Sản phẩm</label>
                <div class="col-sm-6">
                    <select name="products_id" class="form-control">
                        <option value="">Chọn sản phẩm</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->products_id }}"
                            {{ old('products_id', $size->products_id) == $product->products_id ? 'selected' : '' }}>
                            {{ $product->product_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('products_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                    <a href="{{ route('admin.size.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection