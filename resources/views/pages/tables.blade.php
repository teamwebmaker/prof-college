@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.tables.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($professions as $profession)
                <div class="col-lg-4  col-sm-6  mb-4">
                    <x-profession-component :profession="$profession" :language="$language"/>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
