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
    <h2>1: Tại sao lại cần phải đo size dây chuyền?</h2>
    <p class="paragraph-text">Việc đo size dây chuyền là rất quan trọng để bạn có thể chọn được một chiếc dây chuyền vừa vặn với cổ của mình. Nếu bạn không biết kích thước vòng cổ của mình, bạn có thể mua phải một chiếc dây chuyền quá chật hoặc quá rộng, gây khó chịu khi đeo.</p>

    <h2>Kích Thước Dây Chuyền, Dây Cổ và Kiềng</h2>
    <p class="paragraph-text">Dưới đây là bảng kích thước dây chuyền, dây cổ và kiềng phù hợp cho từng đối tượng: nữ, nam và trẻ em.</p>

    <div class="row">
        <!-- Size dây chuyền nữ -->
        <div class="col-12 col-md-6">
            <h3>Size Dây Chuyền, Dây Cổ và Kiềng - Nữ</h3>
            <p>Size từ 40 đến 45.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chiều Dài (cm)</th>
                        <th>Mô Tả</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>40</td>
                        <td>40 cm</td>
                        <td>Sát cổ</td>
                    </tr>
                    <tr>
                        <td>41</td>
                        <td>41 cm</td>
                        <td>Sát cổ</td>
                    </tr>
                    <tr>
                        <td>42</td>
                        <td>42 cm</td>
                        <td>Vừa cổ</td>
                    </tr>
                    <tr>
                        <td>43</td>
                        <td>43 cm</td>
                        <td>Dài vừa</td>
                    </tr>
                    <tr>
                        <td>44</td>
                        <td>44 cm</td>
                        <td>Qua cổ một chút</td>
                    </tr>
                    <tr>
                        <td>45</td>
                        <td>45 cm</td>
                        <td>Dài tự nhiên</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Size dây chuyền nam -->
        <div class="col-12 col-md-6">
            <h3>Size Dây Chuyền, Dây Cổ và Kiềng - Nam</h3>
            <p>Size từ 50 đến 60.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chiều Dài (cm)</th>
                        <th>Mô Tả</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>50</td>
                        <td>50 cm</td>
                        <td>Dài vừa</td>
                    </tr>
                    <tr>
                        <td>55</td>
                        <td>55 cm</td>
                        <td>Qua ngực</td>
                    </tr>
                    <tr>
                        <td>60</td>
                        <td>60 cm</td>
                        <td>Dài xuống bụng</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Size dây chuyền trẻ em -->
        <div class="col-12 col-md-6">
            <h3>Size Dây Chuyền, Dây Cổ và Kiềng - Trẻ Em</h3>
            <p>Size từ 42 đến 48.</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Chiều Dài (cm)</th>
                        <th>Mô Tả</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>42</td>
                        <td>42 cm</td>
                        <td>Sát cổ</td>
                    </tr>
                    <tr>
                        <td>45</td>
                        <td>45 cm</td>
                        <td>Dài tự nhiên</td>
                    </tr>
                    <tr>
                        <td>48</td>
                        <td>48 cm</td>
                        <td>Dài xuống ngực</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <h3>Cách 1: Đo Bằng Thước Dây</h3>
        <p class="paragraph-text">
            Để đo size dây dây chuyền, dây cổ và kiềng chính xác, bạn có thể làm theo các bước sau:
        </p>

        <ol class="paragraph-text">
            <li>Chuẩn bị một thước dây hoặc sợi dây mềm có thể đo được chính xác các đơn vị cm.</li>
            <li>Quấn thước dây quanh cổ của bạn, sao cho nó vừa vặn nhưng không quá chặt.</li>
            <li>Dùng bút đánh dấu điểm giao nhau của sợi dây và đo chiều dài của nó.</li>
            <li>Ghi lại số liệu đo được (cm) để chọn size dây chuyền phù hợp.</li>
            <li>Truyền số liệu này vào bảng size dây chuyền để xác định size phù hợp.</li>
        </ol>

        <p class="paragraph-text">
            Lưu ý: Đo kích thước của cổ vào cuối ngày khi bạn không cảm thấy sưng hoặc căng thẳng.
        </p>

        <div class="mt-4">
            <img src="{{ asset('/public/assets/img/size/mach-ban-cach-do-size-day-chuyen-day-co-02.jpg') }}" alt="Hướng dẫn đo size dây chuyền bằng thước dây" class="img-fluid">
        </div>

    </div>

    <div class="mt-3">
        <h3>Cách 2: Đo theo một chiếc dây chuyền, dây cổ và kiềng có sẵn</h3>
        <p class="paragraph-text">
            Đo size dây chuyền theo một chiếc dây chuyền có sẵn cũng là một phương pháp đơn giản và chính xác. Để thực hiện phương pháp này, làm theo các bước sau:
        </p>

        <ol class="paragraph-text">
            <li>Chọn một chiếc dây chuyền mà bạn thường xuyên đeo và cảm thấy vừa vặn với cổ của bạn.</li>
            <li>Sử dụng thước dây hoặc thước đo để đo chiều dài của chiếc dây chuyền đó.</li>
            <li>Ghi lại giá trị đo được (đơn vị: cm) để xác định size dây chuyền tương ứng.</li>
            <li>Tham khảo bảng size dây chuyền để chuyển đổi giá trị đo được sang size dây chuyền phù hợp.</li>
        </ol>

        <p class="paragraph-text">
            Lưu ý: Đảm bảo chiếc dây chuyền mà bạn đo có kích thước phù hợp và không bị biến dạng, dài quá hoặc ngắn quá so với mong muốn của bạn.
        </p>

        <div class="mt-4">
            <img src="{{ asset('/public/assets/img/size/huong-dan-do-size-day-chuyen-va-day-co.png') }}" alt="Hướng dẫn đo size dây chuyền bằng dây chuyền có sẵn" class="img-fluid">
        </div>
    </div>

</div>
@endsection