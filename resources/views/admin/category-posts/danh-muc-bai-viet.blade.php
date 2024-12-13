@extends('admin.home.home_admin')
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh mục bài viết
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.category-posts.create') }}" data-toggle="modal" class="btn btn-success">
                    Thêm mới danh mục bài viết
                </a>
            </div>
            <div class="col-sm-3">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian sửa</th>
                        <th>Lựa chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <label class="i-checks m-b-none">
                                <input type="checkbox" name="post[]"><i></i>
                            </label>
                        </td>
                        <td>{{ $category->category_posts_id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.category-posts.update-status', $category->category_posts_id) }}" class="btn btn-sm {{ $category->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $category->status == 1 ? 'Hiển thị' : 'Không hiển thị' }}
                            </a>
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.category-posts.edit', $category->category_posts_id) }}" class="btn btn-sm btn-info">Sửa</a>
                            <form action="{{ route('admin.category-posts.destroy', $category->category_posts_id) }}" method="POST" style="display:inline;">
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

    </div>
</div>

@endsection