@extends('admin.home.home_admin')
@section('content')

<section class="panel">
    <header class="panel-heading">
        Thêm mới bài viết
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

        <form class="form-horizontal bucket-form" method="POST" action="{{ route('admin.posts.store') }}">
            @csrf
            <div class="form-group">
                <label class="col-sm-3 control-label">Tiêu đề bài viết</label>
                <div class="col-sm-6">
                    <input type="text" id="postTitle" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Slug (đường dẫn thân thiện)</label>
                <div class="col-sm-6">
                    <input type="text" id="postSlug" name="slug" class="form-control" value="{{ old('slug') }}" required>
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Trạng thái</label>
                <div class="col-lg-6">
                    <select name="status" class="form-control m-bot15" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hiển thị</option>
                    </select>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Mô tả</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Trường Chọn danh mục bài viết -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Danh mục bài viết</label>
                <div class="col-sm-6">
                    <select name="category_posts_id" class="form-control">
                        <option value="">Chọn danh mục bài viết</option>
                        @foreach ($categoryPost as $categoryPosts)
                        <option value="{{ $categoryPosts->category_posts_id }}"
                            {{ old('category_posts_id') == $categoryPosts->category_posts_id ? 'selected' : '' }}>
                            {{ $categoryPosts->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_posts_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Content editor -->
            <div class="form-group">
                <label class="col-sm-3 control-label">Nội dung</label>
                <div class="col-sm-6">
                    <textarea name="content" class="form-control" id="contentEditor" rows="10">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-6">
                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-default">Quay lại</a>
                </div>
            </div>
        </form>

        <script>
            // Hàm tự động tạo slug từ tiêu đề
            document.getElementById('postTitle').addEventListener('input', function() {
                var title = this.value;
                document.getElementById('postSlug').value = convertToSlug(title);
            });

            function convertToSlug(text) {
                return text
                    .toLowerCase()
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        </script>

        <!-- Include CKEditor script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#contentEditor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    </div>
</section>

@endsection