@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>
        @import url({{ asset('styles/components/tab.css') }});
    </style>
@endsection

@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-compass"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.mission.title') }}</span>
        </h2>

        <div class="row g-4">
            <div class="col-12">
                <div class="institutional-section">
                    <div class="section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <h3 class="section-title-text" data-language="{{$language}}">
                                    {{ __('static.mission') }}
                            </h3>
                        </div>
                        <div class="section-content" data-language="{{$language}}">
                            {{$college->mission->$language}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="institutional-section">
                    <div class="section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h3 class="section-title-text" data-language="{{$language}}">
                                {{ __('static.vision') }}
                            </h3>
                        </div>
                        <div class="section-content" data-language="{{$language}}">
                            {{$college->vision->$language}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="institutional-section">
                    <div class="section-card">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <h3 class="section-title-text" data-language="{{$language}}">
                                {{ __('static.values') }}
                            </h3>
                        </div>
                        <div class="section-content" data-language="{{$language}}">
                            {{$college->principles->$language}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Your existing swiper initializations
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
