@extends('welcome')
@section('content')
<style>
    /* Nền bảng */
    .table {
        background: linear-gradient(to bottom, #f9f9f9, #ffefef);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    /* Viền sáng rực Noel */
    .table-bordered {
        border: 3px solid #ff0000;
        box-shadow: 0px 0px 10px 2px rgba(255, 0, 0, 0.6),
            0px 0px 10px 2px rgba(0, 255, 0, 0.6);
    }

    /* Tiêu đề bảng */
    .table thead th {
        background: linear-gradient(to right, #ff0000, #00ff00);
        color: white;
        font-size: 18px;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        border: none;
    }

    /* Dòng kẻ trong bảng */
    .table-bordered td,
    .table-bordered th {
        border: 2px solid rgba(0, 0, 0, 0.2);
        padding: 12px;
        vertical-align: middle;
    }

    /* Các dòng dữ liệu */
    .table tbody tr {
        background-color: #ffffff;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    /* Hiệu ứng khi hover */
    .table tbody tr:hover {
        background-color: #fffae5;
        transform: scale(1.02);
        box-shadow: 0px 0px 10px rgba(255, 215, 0, 0.7);
    }

    /* Nội dung dữ liệu */
    .table tbody td {
        font-size: 16px;
        font-family: 'Roboto', sans-serif;
        color: #393838;
    }

    /* Hiệu ứng số liệu */
    .table tbody td:nth-child(3),
    .table tbody td:nth-child(4) {
        font-weight: bold;
        color: #c00000;
        text-shadow: 0px 0px 8px rgba(255, 0, 0, 0.8);
    }

    /* Chữ Noel động */
    .table thead th:nth-child(2):after {
        content: " 🎄";
        animation: bounce 1.2s infinite alternate;
    }

    /* Hoạt ảnh Bounce */
    @keyframes bounce {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-10px);
        }
    }

    /* Phông nền */
    body {
        background: url('https://cdn.pixabay.com/photo/2018/12/16/18/44/christmas-background-3876474_1280.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    /* Tiêu đề */
    h1 {
        font-family: 'Pacifico', cursive;
        color: #ff0000;
        text-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8),
            0px 0px 10px rgba(0, 255, 0, 0.8);
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        h1 {
            font-size: 24px;
        }
    }
</style>

<div class="container">
    <h1 class="text-center my-4">Danh sách Giá Vàng</h1>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Loại</th>
                <th>Mua Vào</th>
                <th>Bán Ra</th>
                <th>Đơn Vị</th>
                <th>Ngày Cập Nhật</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($goldPrices as $goldPrice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $goldPrice->type }}</td>
                <td>{{ number_format($goldPrice->mua_vao) }} VND</td>
                <td>{{ number_format($goldPrice->ban_ra) }} VND</td>
                <td>{{ $goldPrice->don_vi }}</td>

                <td>{{ \Carbon\Carbon::parse($goldPrice->updated_at)->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Chưa có dữ liệu giá vàng.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection