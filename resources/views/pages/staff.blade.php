@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-person-bounding-box"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.staff.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($staff as $item)
                @if($loop -> first)
                    <div class="col-lg-4 col-md-6 mb-4 first-staff-col">
                        <x-staff-component :staff="$item" :language="$language"/>
                    </div>
                @else
                    <div class="col-lg-4 col-md-6 mb-4">
                        <x-staff-component :staff="$item" :language="$language"/>
                    </div>
                @endif
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
