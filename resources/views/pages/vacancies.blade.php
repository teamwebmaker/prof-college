@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-person-plus"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.vacancies.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($vacancies as $vacancy)
                <div class="col-lg-4  col-sm-6  mb-4">
                    <x-vacancy-component :vacancy="$vacancy" :language="$language"/>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Fancybox.bind("[data-fancybox]", {
        // Optional custom options
        PDF: {
            viewOnLoad: 1, // 0 = fit to width, 1 = fit to page
        },
        iframe: {
            preload: false,
            css: {
                width: "80vw",
                height: "90vh"
            }
        }
    });
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
