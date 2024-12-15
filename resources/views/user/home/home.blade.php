@extends('welcome')
@section('content')
<section class="slider-area">
    <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
        <!-- single slider item start -->
        <div class="hero-single-slide hero-overlay">
            <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home4-slide1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-slider-content slide-1">
                                <h2 class="slide-title">Family Jewelry <span>Collection</span></h2>
                                <h4 class="slide-desc">Designer Jewelry Necklaces-Bracelets-Earings</h4>
                                <a href="shop.html" class="btn btn-hero">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single slider item end -->

        <!-- single slider item start -->
        <div class="hero-single-slide hero-overlay">
            <div class="hero-slider-item bg-img" data-bg="assets/img/slider/home4-slide2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-slider-content slide-2">
                                <h2 class="slide-title">Pearls Spring<span>Collection</span></h2>
                                <h4 class="slide-desc">New pearl earrings and more from $99</h4>
                                <a href="shop.html" class="btn btn-hero">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single slider item start -->
    </div>
</section>

@endsection