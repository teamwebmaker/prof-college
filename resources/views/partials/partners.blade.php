<div class="container-fluid pb-4">
    <div class="container-xxl">
        <div class="swiper swiper-partner">
            <div class="swiper-wrapper">
                @foreach( $partners as $partner )
                    <div class="swiper-slide">
                        <x-partner-component :partner="$partner" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination partner-swiper-pagination"></div>
        </div>
    </div>
</div>

