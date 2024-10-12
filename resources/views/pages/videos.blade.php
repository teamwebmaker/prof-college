@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-camera-reels"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.videos.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($videos as $video)
                <div class="col-xl-4 col-md-6 mb-4">
                    <x-video-component :video="$video" :language="$language"/>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $videos->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
