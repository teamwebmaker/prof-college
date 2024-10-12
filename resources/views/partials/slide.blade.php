<div class="container-fluid swiper-container">
        <div class="swiper swiper-slider">
            <div class="swiper-wrapper">
                @foreach( $slides as $slide )
                    <div class="swiper-slide">
                        <img src="{{ asset('images/slides/' . $slide -> slide) }}" class="w-100 slide-image" alt="" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination slider-pagination"></div>
        </div>
</div>
