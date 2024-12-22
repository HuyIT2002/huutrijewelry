@extends('admin.home.home_admin')

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách Size cho từng sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.size.create') }}" class="btn btn-success">Thêm mới Size</a>
            </div>
            <div class="col-sm-3">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->size_id }}</td>
                        <td>{{ $size->goldProduct->product_name ?? 'Không xác định' }}</td>
                        <td>
                            {{ $size->size ?? 'Sản phẩm này không có size' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.size.update-status', $size->size_id) }}" class="btn btn-sm {{ $size->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $size->status == 1 ? 'Hiển thị' : 'Không hiển thị' }}
                            </a>
                        </td>
                        <td>{{ $size->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.size.edit', $size->size_id) }}" class="btn btn-info btn-sm">Sửa</a>
                            <form action="{{ route('admin.size.destroy', $size->size_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
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
                        <li class="page-item {{ $sizes->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $sizes->previousPageUrl() }}" aria-label="Previous">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Hiển thị các số trang -->
                        @foreach ($sizes->getUrlRange(1, $sizes->lastPage()) as $page => $url)
                        <li class="page-item {{ $sizes->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        <!-- Nút Next -->
                        <li class="page-item {{ $sizes->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $sizes->nextPageUrl() }}" aria-label="Next">
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