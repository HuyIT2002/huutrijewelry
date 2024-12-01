@extends('admin.home.home_admin')
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Biến động giá vàng
        </div>
        <div class="row w3-res-tb">

            <div class="col-sm-5 m-b-xs">
                <a href="{{ route('admin.gold-prices.create') }}" data-toggle="modal" class="btn btn-success">
                    Thêm mới giá vàng
                </a>
            </div>
            <div class="col-sm-3">
                <!-- <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div> -->
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
                        <th>Mua vào</th>
                        <th>Bán ra</th>
                        <th>Loại vàng</th>
                        <th>Đơn vị</th>
                        <th>Trạng thái</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian sủa</th>
                        <th>Lựa chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($goldPrices as $price)
                    <tr>
                        <td>
                            <label class="i-checks m-b-none">
                                <input type="checkbox" name="post[]"><i></i>
                            </label>
                        </td>
                        <td>{{ $price->gold_prices_id }}</td>
                        <td>{{ number_format($price->mua_vao) }}</td>
                        <td>{{ number_format($price->ban_ra) }}</td>
                        <td>{{ $price->type }}</td>
                        <td>{{ $price->don_vi }}</td>
                        <td>
                            <a href="{{ route('admin.gold-prices.update-status', $price->gold_prices_id) }}" class="btn btn-sm {{ $price->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                {{ $price->status == 1 ? 'Hiển thị' : 'Không hiển thị' }}
                            </a>
                        </td>
                        <td>{{ $price->created_at }}</td>
                        <td>{{ $price->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.gold-prices.edit', $price->gold_prices_id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.gold-prices.destroy', $price->gold_prices_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
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