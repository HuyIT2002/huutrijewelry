@extends('welcome')
@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">About us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="about-us section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-thumb">
                    <img src="{{ asset('/public/assets/img/about/ve-chung-toi.jpg') }}" alt="about thumb">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <h2 class="about-title">HỮU TRÍ JEWELRY </h2>
                    <h5 class="about-sub-title">
                        Chào mừng quý khách đến với Công ty TNHH TM và DV Vàng Bạc Đá Quý Hữu Trí,
                        một thương hiệu uy tín và lâu đời trong ngành vàng bạc đá quý tại Việt Nam.
                        Được thành lập vào ngày 17/04/2016, chúng tôi tự hào mang đến những sản phẩm tinh xảo,
                        chất lượng vượt trội, và dịch vụ tận tâm, đồng hành cùng khách hàng trên hành trình tỏa sáng.
                    </h5>
                    <p>Ra đời với tầm nhìn trở thành điểm đến hàng đầu trong lĩnh vực vàng bạc đá quý, Công ty TNHH Vàng
                        Bạc Đá Quý Hữu Trí không ngừng nỗ lực để khẳng định vị thế của mình. Chúng tôi chuyên sản xuất,
                        kinh doanh và phân phối các sản phẩm vàng bạc, đá quý, trang sức cưới, và phụ kiện thời trang
                        cao cấp.
                        Với 8 năm hoạt động trên thị trường, chúng tôi không chỉ là một nhà cung cấp sản phẩm mà còn là
                        người bạn đồng hành, mang đến sự hài lòng và niềm tin cho hàng nghìn khách hàng.
                    </p>
                </div>
            </div>
        </div>
        <br>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-content">
                    <h2 class="about-title">Sản phẩm và dịch vụ </h2>
                    <h5 class="about-sub-title">
                        Chúng tôi cung cấp đa dạng các sản phẩm và dịch vụ:
                    </h5>
                    <p>Trang sức vàng Thiết kế tinh xảo, phù hợp với mọi phong cách.</p>
                    <p>Đá quý cao cấp: Chọn lọc kỹ lưỡng, chuẩn chất lượng quốc tế.</p>
                    <p>Trang sức cưới: Bộ sưu tập hoàn hảo cho ngày trọng đại.</p>
                    <p>Dịch vụ chế tác theo yêu cầu: Đáp ứng mọi ý tưởng sáng tạo của khách hàng.</p>
                    <p>Dịch vụ kiểm định đá quý: Chính xác, minh bạch và đáng tin cậy.</p>+
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-thumb">
                    <img src="{{ asset('/public/assets/img/about/san-pham-va-dich-vu.jpg') }}" alt="about thumb">
                </div>
            </div>
        </div>
        <br>
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-thumb">
                    <img src="{{ asset('/public/assets/img/about/ve-chung-toi.jpg') }}" alt="about thumb">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <h2 class="about-title">HỮU TRÍ JEWELRY VỀ GIÁ TRỊ CỐT LÕI </h2>
                    <h5 class="about-sub-title">Giá trị cốt lõi</h5>
                    <p>Chất lượng: Chúng tôi cam kết cung cấp sản phẩm đạt tiêu chuẩn cao nhất.</p>
                    <p>Sáng tạo: Không ngừng đổi mới trong thiết kế để đáp ứng xu hướng thời đại.</p>
                    <p>Tận tâm: Lấy khách hàng làm trung tâm, luôn đồng hành và lắng nghe.</p>
                </div>
            </div>
        </div>
        <br>
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-content">
                    <h2 class="about-title">Tầm nhìn và sứ mệnh </h2>
                    <h5 class="about-sub-title">
                    Chúng tôi đặt mục tiêu trở thành thương hiệu vàng bạc đá quý hàng đầu Việt Nam, mang lại giá trị đích thực không chỉ qua sản phẩm mà còn trong cách chúng tôi kết nối và phục vụ cộng đồng.
                    </h5>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-thumb">
                    <img src="{{ asset('/public/assets/img/about/ve-chung-toi.jpg') }}" alt="about thumb">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about us area end -->
@endsection
