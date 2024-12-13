@extends('admin.home.home_admin')
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh mục bài viết
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.posts.create') }}" data-toggle="modal" class="btn btn-success">
                    Thêm mới bài viết
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
                        <th>Tiêu đề</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>
                            <label class="i-checks m-b-none">
                                <input type="checkbox" name="post[]"><i></i>
                            </label>
                        </td>
                        <td>{{ $post->posts_id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ strip_tags($post->content) }}</td>
                        <!-- Giả sử bạn có cột mô tả trong bảng posts -->
                        <td>
                            <a href="{{ route('admin.posts.update-status', $post->posts_id) }}" class="btn btn-sm {{ $post->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $post->status == 1 ? 'Mở' : 'Đóng' }}
                            </a>
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->posts_id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->posts_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
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