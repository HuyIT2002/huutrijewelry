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

    <h2>1: Tại sao lại cần phải đo size lắc tay và vòng tay?</h2>
    <p class="paragraph-text">Việc đo size lắc tay và vòng tay là rất cần thiết để bạn có thể chọn được một chiếc lắc tay hoặc vòng tay phù hợp với kích thước cổ tay của mình. Khi mua một chiếc lắc tay hoặc vòng tay, nếu bạn không biết kích thước cổ tay của mình, bạn có thể mua phải sản phẩm quá chật hoặc quá rộng. Điều này sẽ gây khó chịu khi đeo và làm giảm sự thẩm mỹ khi sử dụng phụ kiện.</p>


    <div class="row">
        <!-- Size nhẫn nam -->
        <h2>1: Lắc tay</h2>
        <div class="col-12 col-md-6">
            <h3>Size Lắc Tay - Trẻ Em</h3>
            <p>Kích thước lắc tay trẻ em từ size 14 đến size 16.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>14</td>
                        <td>4.4</td>
                        <td>14.0</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>4.8</td>
                        <td>15.0</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>5.1</td>
                        <td>16.0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <h3>Size Lắc Tay - Nữ</h3>
            <p>Kích thước lắc tay nữ từ size 16 đến size 18.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>16</td>
                        <td>5.1</td>
                        <td>16.0</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>5.4</td>
                        <td>17.0</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>5.7</td>
                        <td>18.0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <h3>Size Lắc Tay - Nam</h3>
            <p>Kích thước lắc tay nam từ size 19 đến size 21.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>19</td>
                        <td>6.0</td>
                        <td>19.0</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>6.4</td>
                        <td>20.0</td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>6.7</td>
                        <td>21.0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <h3>Size Lắc Chân - Nữ</h3>
            <p>Kích thước lắc chân nữ từ size 23 đến size 25.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Chân (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>23</td>
                        <td>7.3</td>
                        <td>23.0</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>7.6</td>
                        <td>24.0</td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>8.0</td>
                        <td>25.0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <h3>Cách 1: Đo Bằng Thước</h3>
            <p class="paragraph-text">
                Đo size lắc tay hoặc lắc chân bằng thước là phương pháp nhanh và chính xác. Làm theo các bước sau:
            </p>

            <ol class="paragraph-text">
                <li>Chuẩn bị một chiếc thước đo chiều dài (có đơn vị mm).</li>
                <li>Đo trực tiếp chiều dài của lắc tay hoặc lắc chân hiện có mà bạn cảm thấy vừa vặn.</li>
                <li>Ghi lại giá trị đo được (đơn vị: cm hoặc mm).</li>
                <li>So sánh với bảng size lắc tay/lắc chân để xác định size phù hợp.</li>
            </ol>

            <p class="paragraph-text">
                Lưu ý: Đo khi tay hoặc chân không bị sưng hoặc co rút để đảm bảo độ chính xác.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/public/assets/img/size/huong-dan-do-size-lac-va-vong-tay.png') }}" alt="Hướng dẫn đo size lắc bằng thước" class="img-fluid">
            </div>
        </div>

        <div class="mt-3">
            <h3>Cách 2: Đo Thủ Công Bằng Giấy hoặc Dây</h3>
            <p class="paragraph-text">
                Nếu không có lắc tay hoặc lắc chân để đo, bạn có thể sử dụng phương pháp thủ công để đo kích thước tay/chân:
            </p>

            <ol class="paragraph-text">
                <li>Chuẩn bị một tờ giấy dài hoặc dây mềm và một chiếc thước kẻ.</li>
                <li>Quấn giấy hoặc dây quanh cổ tay/cổ chân sao cho vừa vặn nhưng không quá chặt.</li>
                <li>Đánh dấu điểm giao nhau của hai đầu giấy hoặc dây.</li>
                <li>Dùng thước đo chiều dài đoạn giấy/dây vừa quấn (đơn vị mm).</li>
                <li>So sánh giá trị đo được với bảng size lắc tay/lắc chân để tìm size phù hợp.</li>
            </ol>

            <p class="paragraph-text">
                Lưu ý: Đo ở vị trí bạn muốn đeo lắc để đảm bảo độ chính xác.
            </p>

            <div class="mt-4">
                <img src="{{ asset('/public/assets/img/size/huong-dan-do-size-lac-va-vong-tay-06.png') }}" alt="Hướng dẫn đo size lắc bằng giấy hoặc dây" class="img-fluid">
            </div>
        </div>
        <h2>2: Vòng tay</h2>
        <div class="col-12 col-md-6">
            <h3>Size Vòng Tay - Nữ</h3>
            <p>Kích thước vòng tay nữ từ size 50 đến size 54.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>50</td>
                        <td>5.0</td>
                        <td>15.7</td>
                    </tr>
                    <tr>
                        <td>51</td>
                        <td>5.1</td>
                        <td>16.0</td>
                    </tr>
                    <tr>
                        <td>52</td>
                        <td>5.2</td>
                        <td>16.3</td>
                    </tr>
                    <tr>
                        <td>53</td>
                        <td>5.3</td>
                        <td>16.6</td>
                    </tr>
                    <tr>
                        <td>54</td>
                        <td>5.4</td>
                        <td>16.9</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <h3>Size Vòng Tay - Nam</h3>
            <p>Kích thước vòng tay nam từ size 55 đến size 56.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>55</td>
                        <td>5.5</td>
                        <td>17.3</td>
                    </tr>
                    <tr>
                        <td>56</td>
                        <td>5.6</td>
                        <td>17.7</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-6">
            <h3>Size Vòng Tay - Em Bé</h3>
            <p>Kích thước vòng tay em bé từ size 36 đến size 46.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Đường Kính (cm)</th>
                        <th>Vòng Tay (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>36</td>
                        <td>3.6</td>
                        <td>11.3</td>
                    </tr>
                    <tr>
                        <td>38</td>
                        <td>3.8</td>
                        <td>12.0</td>
                    </tr>
                    <tr>
                        <td>40</td>
                        <td>4.0</td>
                        <td>12.6</td>
                    </tr>
                    <tr>
                        <td>42</td>
                        <td>4.2</td>
                        <td>13.2</td>
                    </tr>
                    <tr>
                        <td>44</td>
                        <td>4.4</td>
                        <td>13.8</td>
                    </tr>
                    <tr>
                        <td>46</td>
                        <td>4.6</td>
                        <td>14.4</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container mt-3">
            <!-- Hướng dẫn đo vòng tay - Cách 1 -->
            <div class="mt-3">
                <h3>Cách 1: Đo Bằng Thước</h3>
                <p class="paragraph-text">
                    Đo size vòng tay bằng thước là phương pháp nhanh và chính xác. Làm theo các bước sau:
                </p>

                <ol class="paragraph-text">
                    <li>Chuẩn bị một chiếc thước đo chiều dài (có đơn vị mm hoặc cm).</li>
                    <li>Đo trực tiếp chiều dài vòng tay mà bạn cảm thấy vừa vặn.</li>
                    <li>Ghi lại giá trị đo được (đơn vị: cm hoặc mm).</li>
                    <li>So sánh với bảng size vòng tay để xác định size phù hợp.</li>
                </ol>

                <p class="paragraph-text">
                    Lưu ý: Đo khi tay không bị sưng hoặc co rút để đảm bảo độ chính xác.
                </p>

                <div class="mt-4 text-center">
                    <img src="{{ asset('/public/assets/img/size/1.png') }}" alt="Hướng dẫn đo size vòng tay bằng thước" class="img-fluid">
                </div>
            </div>

            <!-- Hướng dẫn đo vòng tay - Cách 2 -->
            <div class="mt-3">
                <h3>Cách 2: Đo Thủ Công Bằng Giấy hoặc Dây</h3>
                <p class="paragraph-text">
                    Nếu không có vòng tay hoặc thước đo, bạn có thể sử dụng phương pháp thủ công để đo kích thước tay:
                </p>

                <ol class="paragraph-text">
                    <li>Chuẩn bị một mảnh giấy dài hoặc dây mềm và một chiếc thước kẻ.</li>
                    <li>Quấn giấy hoặc dây quanh cổ tay sao cho vừa vặn nhưng không quá chặt.</li>
                    <li>Đánh dấu điểm giao nhau của hai đầu giấy hoặc dây.</li>
                    <li>Dùng thước đo chiều dài đoạn giấy hoặc dây (đơn vị: mm).</li>
                    <li>So sánh giá trị đo được với bảng size vòng tay để tìm size phù hợp.</li>
                </ol>

                <p class="paragraph-text">
                    Lưu ý: Đo ở vị trí bạn muốn đeo vòng tay để đảm bảo độ chính xác.
                </p>

                <div class="mt-4 text-center">
                    <img src="{{ asset('/public/assets/img/size/2.png') }}" alt="Hướng dẫn đo size vòng tay bằng giấy hoặc dây" class="img-fluid">
                </div>
            </div>
        </div>

    </div>
</div>
@endsection