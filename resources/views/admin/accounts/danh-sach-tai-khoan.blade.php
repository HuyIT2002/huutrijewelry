@extends('admin.home.home_admin')

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách tài khoản
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.accounts.create') }}" class="btn btn-success">Thêm mới tài khoản</a>
            </div>
            <div class="col-sm-3">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Role</th> <!-- Thêm cột Role -->
                        <th>Trạng thái</th>
                        <th>Images</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->admin_id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            @if($admin->role)
                            @switch($admin->role->type)
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
                            @default
                            Người chưa được kiểm duyệt
                            @endswitch
                            @else
                            Chưa xác định
                            @endif
                        </td>

                        <td>
                            @if($admin->role_id == 1)
                            <span class="badge badge-warning">Quyền cao nhất không được chỉnh sửa</span>
                            @else
                            <a href="{{ route('admin.accounts.update-status', $admin->admin_id) }}" class="btn btn-sm {{ $admin->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $admin->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                            </a>
                            @endif
                        </td>


                        <td>
                            <!-- Hiển thị ảnh nếu có -->
                            @if ($admin->admin_image)
                            <img src="{{ asset('public/admin/images/admin/' . $admin->admin_image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                            @else
                            Không có ảnh
                            @endif
                        </td>
                        <td>{{ $admin->created_at }}</td>
                        <td>
                            @if($admin->role_id != 1)
                            <a href="{{ route('admin.accounts.edit', $admin->admin_id) }}" class="btn btn-info btn-sm">Sửa</a>
                            <form action="{{ route('admin.accounts.destroy', $admin->admin_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                            @else
                            <span class="badge badge-secondary">Quyền cao nhất, không thể sửa hoặc xóa</span>
                            @endif
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
                        <li class="page-item {{ $admins->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $admins->previousPageUrl() }}" aria-label="Previous">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Hiển thị các số trang -->
                        @foreach ($admins->getUrlRange(1, $admins->lastPage()) as $page => $url)
                        <li class="page-item {{ $admins->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        <!-- Nút Next -->
                        <li class="page-item {{ $admins->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $admins->nextPageUrl() }}" aria-label="Next">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection