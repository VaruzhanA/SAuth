@extends('frontend.layouts.app')

@section('content')
<section class="news-section news-section--news" id="news-section">
    <div class="row">
        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>

        <a class="news-slider-title-link" href="#">
            <h2 class="news-slider-title">Latest News</h2>
        </a>

        <div class="swiper-container swiper-container-horizontal" id="news-slider">
            <div class="swiper-wrapper" style="transition-duration: 300ms;">
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>

        <div class="swiper-container-horizontal">
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        </div>
    </div>
</section>
<section class="panels-section">
    <div class="row">
        <div class="row gutters panels-feed panels-feed--home panels-feed--home_content">
            <div class="col-xs-12 col-md-4">
                <div class="panel">
                    <a class="panel-image" href="#" tabindex="-1">
                        <img src="{{asset('assets/images/2020-home-panel-1.jpg')}}" alt="">
                    </a>
                    <div class="panel-title">
                        <div>
                            <h3>About Us</h3>
                        </div>
                    </div>
                    <a href="#" class="panel-link button">View More</a>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="panel">
                    <a class="panel-image" href="#" tabindex="-1">
                        <img src="{{asset('assets/images/2020-home-panel-2.jpg')}}" alt="">
                    </a>

                    <div class="panel-title">
                        <div>
                            <h3>Courses</h3>
                        </div>
                    </div>
                    <a href="#" class="panel-link button">View More</a>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="panel">
                    <a class="panel-image" href="#" tabindex="-1">
                        <img src="{{asset('assets/images/2020-home-panel-3.jpg')}}" alt="">
                    </a>
                    <div class="panel-title">
                        <div>
                            <h3>News</h3>
                        </div>
                    </div>
                    <a href="#" class="panel-link button">View More</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
