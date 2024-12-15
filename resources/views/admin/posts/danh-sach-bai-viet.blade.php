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
                        <th>Images</th>
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
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 10, '...') }}</td>

                        <td>
                            <!-- Hiển thị ảnh nếu có -->
                            @if ($post->images)
                            <img src="{{ asset('public/admin/images/post/' . $post->images) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                            @else
                            Không có ảnh
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.posts.update-status', $post->posts_id) }}" class="btn btn-sm {{ $post->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $post->status == 1 ? 'Mở' : 'Đóng' }}
                            </a>
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->posts_id) }}" class="btn btn-sm btn-info">Edit</a>
                            <br>
                            <!-- Nút Detail, mở modal -->
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#postDetailModal" data-id="{{ $post->posts_id }}" data-title="{{ $post->title }}" data-content="{{ strip_tags($post->content) }}"
                                data-image="{{ asset('public/admin/images/post/' . $post->images) }}" data-slug="{{ $post->slug }}">
                                Detail
                            </button>
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

<!-- Modal Hiển thị chi tiết bài viết -->
<div class="modal fade" id="postDetailModal" tabindex="-1" role="dialog" aria-labelledby="postDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postDetailModalLabel">Chi tiết bài viết</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="postTitle">Tiêu đề</label>
                    <input type="text" class="form-control" id="postTitle" disabled>
                </div>
                <div class="form-group">
                    <label for="postSlug">Slug</label>
                    <input type="text" class="form-control" id="postSlug" disabled>
                </div>
                <div class="form-group">
                    <label for="postContent">Nội dung</label>
                    <textarea class="form-control" id="postContent" rows="5" disabled></textarea>
                </div>
                <div class="form-group">
                    <img id="postImage" style="max-width: 30%; height: auto;" alt="Image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Khi nhấn vào nút Detail, hiển thị thông tin bài viết trong modal
    $('#postDetailModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Lấy nút đã nhấn
        var title = button.data('title');
        var slug = button.data('slug'); // Lấy slug
        var content = button.data('content');
        var image = button.data('image');

        var modal = $(this);
        modal.find('#postTitle').val(title);
        modal.find('#postSlug').val(slug); // Điền giá trị slug vào input
        modal.find('#postContent').val(content);
        modal.find('#postImage').attr('src', image);
    });
</script>


@endsection