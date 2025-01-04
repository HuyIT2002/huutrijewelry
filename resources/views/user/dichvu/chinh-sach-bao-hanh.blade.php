@extends('welcome')
<style>
    .service-policy {
        background-color: #F5F5F5;
        /* Màu nền sáng, phù hợp với trang web trang sức */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .service-policy h1,
    .service-policy h3,
    .service-policy h4 {
        font-family: 'Arial', sans-serif;
        color: #DAA520;
        /* Màu vàng sang trọng */
    }

    .service-policy ul {
        list-style-type: none;
        padding-left: 0;
    }

    .service-policy ul li {
        padding-left: 20px;
        text-align: justify;
    }

    .service-policy p {
        text-align: justify;
        color: #555;
        /* Màu văn bản tối, dễ đọc */
    }

    /* Responsive styles */
    @media (max-width: 767px) {
        .service-policy h1 {
            font-size: 28px;
        }

        .service-policy h3,
        .service-policy h4 {
            font-size: 20px;
        }

        .service-policy ul li {
            font-size: 14px;
        }

        .service-policy p {
            font-size: 14px;
        }
    }
</style>

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold" style="color: #DAA520; font-size: 36px;">Dịch Vụ Bảo Hành</h1>

    <!-- Nội dung dịch vụ bảo hành -->
    <div class="service-policy mt-4">
        <h3 class="fw-bold" style="color: #DAA520;">1. Sản phẩm 610/416 mua tại Hữu Trí Jewelry được đổi sang sản phẩm khác trong 7 ngày</h3>
        <p class="text-dark">Kể từ ngày mua trên hóa đơn, quý khách được đổi miễn phí.</p>

        <h4 class="fw-bold" style="color: #DAA520;">+ Điều kiện đổi mới miễn phí:</h4>
        <ul class="text-dark">
            <li>Sản phẩm mua tại Hữu Trí Jewelry chưa qua sử dụng, còn đầy đủ giấy tờ hóa đơn, kiểm định.</li>
            <li>Sản phẩm phải còn nguyên vẹn, không bị hư hỏng, trầy xước, đúng trọng lượng ghi trên hóa đơn bán hàng kèm theo.</li>
            <li>Sản phẩm bị lỗi và được Hữu Trí Jewelry xác nhận là lỗi do công ty không phải do khách sử dụng gây ra.</li>
            <li>Chỉ được đổi sang sản phẩm cùng loại (610 đổi 610).</li>
            <li>Chỉ được đổi không được trả hàng lấy lại tiền.</li>
            <li>Giá vàng tính theo giá hiện tại tại thời điểm đổi món khác.</li>
            <li>Sản phẩm đổi phải bằng hoặc lớn hơn sản phẩm cũ.</li>
            <li>Chỉ được đổi mới 1 lần duy nhất. Sản phẩm đã được đổi trước đó không được đổi mới trừ trường hợp có lỗi do nhà sản xuất mà khi bán không phát hiện.</li>
            <li>Miễn phí tân trang làm mới, gắn đá rớt CZ sửa chữa nhẹ, khắc tên.</li>
            <li>Miễn phí mạ trắng (cho lần đầu tiên) khi khách hàng mua sản phẩm, Italy 750, 416, bạch kim.</li>
        </ul>

        <h4 class="fw-bold" style="color: #DAA520;">+ Các trường hợp không được đổi mới miễn phí:</h4>
        <ul class="text-dark">
            <li>Trang sức đồng hồ, vòng đá, trầm, trang sức phong thủy.</li>
            <li>Dạng ống bộng như Ximen, vòng ống, kiềng cổ vàng 610, 416, 980 loại không khóa, vòng kiềng.</li>
            <li>Sản phẩm đã cắt, sửa, thu ni, làm lớn theo yêu cầu của khách.</li>
            <li>Sản phẩm đã thay đổi màu sắc, đá màu, hình dạng theo yêu cầu của khách.</li>
            <li>Sản phẩm đặt làm riêng hoặc đã khắc tên riêng cho khách.</li>
        </ul>

        <h3 class="fw-bold" style="color: #DAA520;">2. Quy định dịch vụ sửa chữa và tân trang</h3>
        <ul class="text-dark">
            <li>Sản phẩm mang đến sửa chữa phải được kiểm tra và lập biên nhận rõ ràng, bao gồm thông tin khách hàng và tình trạng sản phẩm.</li>
            <li>Cam kết hoàn thành sửa chữa trong vòng 1-5 ngày hoặc theo thỏa thuận với khách hàng.</li>
            <li>Khách hàng được thông báo ngay khi sản phẩm hoàn thành.</li>
            <li>Cửa hàng chịu trách nhiệm bảo quản sản phẩm trong quá trình sửa chữa và giao lại đúng hiện trạng.</li>
            <li>Trong trường hợp mất mát hoặc hư hỏng, cửa hàng sẽ bồi thường phù hợp với giá trị sản phẩm.</li>
        </ul>

        <h3 class="fw-bold" style="color: #DAA520;">3. Quy định dành cho khách hàng</h3>
        <ul class="text-dark">
            <li>Khách hàng cần cung cấp đầy đủ thông tin cá nhân khi mua hàng hoặc yêu cầu dịch vụ lớn.</li>
            <li>Thanh toán đúng hạn và kiểm tra kỹ sản phẩm trước khi rời cửa hàng.</li>
        </ul>

        <p class="text-dark mt-4">Lưu ý: Nội quy này được áp dụng nhằm bảo vệ quyền lợi của cả khách hàng và cửa hàng. Mọi khiếu nại hoặc thắc mắc vui lòng liên hệ: 0914 38 37 79</p>
        <h4 class="fw-bold mt-4" style="color: #DAA520;">Ban hành bởi: CTY TNHH TM DV VÀNG BẠC ĐÁ QUÝ HỮU TRÍ JEWELRY.</h4>

    </div>
</div>
@endsection