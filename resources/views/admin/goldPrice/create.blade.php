@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Thêm mới giá vàng
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


        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.gold-prices.store') }}">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Mua vào</label>
                <div class="col-sm-6">
                    <input type="text" name="mua_vao" class="form-control" value="{{ old('mua_vao') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Bán ra</label>
                <div class="col-sm-6">
                    <input type="text" name="ban_ra" class="form-control" value="{{ old('ban_ra') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Đơn vị</label>
                <div class="col-sm-6">
                    <input type="text" name="don_vi" class="form-control" value="{{ old('don_vi') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Loại vàng</label>
                <div class="col-sm-6">
                    <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
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
                    <a href="{{ route('admin.gold-prices.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection