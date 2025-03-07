<div class="container-fluid swiper-container">
    <div class="swiper swiper-sub">
        <div class="swiper-wrapper">
            @foreach( $slides as $slide )
                <div class="swiper-slide">
                    <img src="{{ asset('images/sub-slides/' . $slide -> slide) }}" class="w-100" alt="" />
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination sub-slider-pagination"></div>
    </div>
</div>
