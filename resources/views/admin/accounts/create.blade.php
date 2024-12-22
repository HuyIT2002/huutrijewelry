@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Thêm mới một tài khoản
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

        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.accounts.store', $accounts->admin_id) }}" enctype="multipart/form-data">
            @csrf
            <!-- Tên tài khoản -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên tài khoản</label>
                <div class="col-sm-6">
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Mật khẩu -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mật khẩu</label>
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Vai trò -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Vai trò</label>
                <div class="col-sm-6">
                    <select name="role_id" class="form-control" required>
                        <option value="">Chọn vai trò</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                            @switch($role->type)
                            @case(1)
                            Giám đốc
                            @break
                            @case(2)
                            Quản lý
                            @break
                            @case(3)
                            Nhân viên
                            @break
                            @case(4)
                            Người chưa được kiểm duyệt
                            @break
                            @default
                            Không xác định
                            @endswitch
                        </option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-sm-6">
                    <select name="status" class="form-control" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Thêm trường admin_image -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Ảnh</label>
                <div class="col-sm-6">
                    <input type="file" name="admin_image" class="form-control" accept="image/*" onchange="previewImage(event)">
                    @error('admin_image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="imagePreview" src="#" alt="Ảnh bài viết" style="max-width: 200px; display: none;" />
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                    <a href="{{ route('admin.accounts.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</section>
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

@endsection