@extends('welcome')
<style>
    /* Cải thiện kiểu chữ cho đoạn văn */
    .paragraph-text {
        font-size: 18px;
        /* Tăng kích thước chữ */
        font-family: 'Arial', sans-serif;
        /* Chọn font chữ dễ đọc */
        line-height: 1.8;
        /* Cải thiện khoảng cách giữa các dòng */
        color: #333;
        /* Chọn màu chữ đen đậm để dễ nhìn */
        text-align: justify;
        /* Căn đều chữ cho đoạn văn */
        margin-bottom: 20px;
        /* Tạo khoảng cách dưới đoạn văn */
    }

    /* Thêm hiệu ứng hover khi di chuột lên đoạn văn */
    .paragraph-text:hover {
        color: #0056b3;
        /* Thay đổi màu sắc khi hover */
        cursor: pointer;
        /* Thêm hiệu ứng chuột */
    }

    .paragraph-text ol {
        margin-left: 20px;
    }

    .paragraph-text li {
        font-size: 16px;
    }

    /* Đảm bảo hình ảnh hiển thị đúng */
    img.img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>
@section('content')
<div class="container my-5">

    <h2>1: Tại sao lại cần phải đo size nhẫn?</h2>
    <p class="paragraph-text">Việc đo size nhẫn (hay còn gọi là ni nhẫn) là rất cần thiết để bạn có thể chọn được một chiếc
        nhẫn phù hợp với kích thước ngón tay của mình. Khi mua một chiếc nhẫn, nếu bạn không biết kích
        thước của ngón tay của mình thì có thể bạn sẽ mua phải một chiếc nhẫn quá to hoặc quá nhỏ so
        với ngón tay của mình. Điều này sẽ gây khó chịu và không thoải mái khi đeo nhẫn.</p>

    <div class="row">
        <!-- Size nhẫn nữ -->
        <div class="col-12 col-md-6">
            <h3>Size Nhẫn Nữ </h3>
            <p>Size nhẫn nữ từ size 8 đến size 14.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (mm)</th>
                        <th>Vòng Ngón Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8</td>
                        <td>16.5</td>
                        <td>14.5</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>17.0</td>
                        <td>15.0</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>17.5</td>
                        <td>15.5</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>18.0</td>
                        <td>16.0</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>18.5</td>
                        <td>16.5</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>19.0</td>
                        <td>17.0</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>19.5</td>
                        <td>17.5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Size nhẫn nam -->
        <div class="col-12 col-md-6">
            <h3>Size Nhẫn Nam </h3>
            <p>Size nhẫn nam từ size 14 đến size 20.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (mm)</th>
                        <th>Vòng Ngón Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>14</td>
                        <td>20.0</td>
                        <td>18.0</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>20.5</td>
                        <td>18.5</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>21.0</td>
                        <td>19.0</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>21.5</td>
                        <td>19.5</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>22.0</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>22.5</td>
                        <td>20.5</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>23.0</td>
                        <td>21.0</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <h3>Cách 1: Đo Bằng Tờ Giấy & Thước</h3>
            <p class="paragraph-text">
                Để đo size nhẫn chính xác bằng tờ giấy và thước, bạn chỉ cần thực hiện theo các bước sau:
            </p>

            <ol class="paragraph-text">
                <li>Chuẩn bị một tờ giấy mỏng và một chiếc thước kẻ hoặc dây đo có thể đo được đơn vị milimét.</li>
                <li>Quấn tờ giấy quanh ngón tay của bạn, sao cho vừa vặn nhưng không quá chặt.</li>
                <li>Dùng bút đánh dấu điểm gặp nhau của hai đầu tờ giấy.</li>
                <li>Sau đó, dùng thước để đo chiều dài đoạn dây đã quấn quanh ngón tay của bạn. Ghi lại số liệu này (mm).</li>
                <li>Truyền số liệu này vào bảng size nhẫn để xác định size phù hợp (ví dụ: nếu chiều dài là 50mm, thì bạn sẽ cần size nhẫn 10).</li>
            </ol>

            <p class="paragraph-text">
                Lưu ý: Đo kích thước của ngón tay vào cuối ngày khi ngón tay của bạn không bị sưng hoặc co lại.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/public/assets/img/size/huong-dan-do-size-nhan-2.jpg') }}" alt="Hướng dẫn đo size nhẫn bằng giấy" class="img-fluid">
            </div>

        </div>
        <div class="mt-3">
            <h3>Cách 2: Đo theo một chiếc nhẫn có sẵn</h3>
            <p class="paragraph-text">
                Đo size nhẫn theo một chiếc nhẫn có sẵn là một phương pháp đơn giản và chính xác nếu bạn có chiếc nhẫn mà mình muốn sao chép. Để thực hiện phương pháp này, làm theo các bước sau:
            </p>

            <ol class="paragraph-text">
                <li>Chọn một chiếc nhẫn mà bạn thường xuyên đeo và cảm thấy vừa vặn với ngón tay mà bạn muốn đo.</li>
                <li>Sử dụng thước đo hoặc thước dây để đo đường kính trong của chiếc nhẫn đó. Đo từ cạnh này đến cạnh kia của hình tròn bên trong của nhẫn.</li>
                <li>Ghi lại giá trị đo được (đơn vị: mm) để xác định size nhẫn tương ứng.</li>
                <li>Tham khảo bảng size nhẫn để chuyển đổi giá trị đo được sang size nhẫn phù hợp. Ví dụ: Nếu bạn đo được đường kính là 16mm, bạn sẽ cần size 8.</li>
            </ol>

            <p class="paragraph-text">
                Lưu ý: Đảm bảo chiếc nhẫn mà bạn đo có kích thước phù hợp và không bị biến dạng, cong vênh.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/public/assets/img/size/huong-dan-do-size-nhan-3.jpg') }}" alt="Hướng dẫn đo size nhẫn bằng chiếc nhẫn có sẵn" class="img-fluid">
            </div>
        </div>

    </div>
</div>
@endsection