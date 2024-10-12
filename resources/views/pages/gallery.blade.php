@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-images"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.galleries.title') }}</span>
        </h2>
    <div class="gallery">
        @foreach($photoGallery as $item )
            <x-gallery-component :item="$item" :language="$language"/>
        @endforeach
    </div>
        <div class="row">
            <div class="col-md-12">
                {!! $photoGallery->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
