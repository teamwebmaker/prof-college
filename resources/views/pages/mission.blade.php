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
        <nav>
            <div class="nav nav-tabs" id="institutional-tabs" role="tablist">
                <button class="nav-link active" id="mission-tab" data-bs-toggle="tab" data-bs-target="#mission-content" type="button" role="tab" aria-controls="mission" aria-selected="true" data-language="{{ $language }}">
                    {{ __('static.mission') }}
                </button>
                <button class="nav-link" id="vision-tab" data-bs-toggle="tab" data-bs-target="#vision-content" type="button" role="tab" aria-controls="vision" aria-selected="false" data-language="{{ $language }}">
                    {{ __('static.vision') }}
                </button>
                <button class="nav-link" id="values-tab" data-bs-toggle="tab" data-bs-target="#values-content" type="button" role="tab" aria-controls="values" aria-selected="false" data-language="{{ $language }}">
                    {{ __('static.values') }}
                </button>
            </div>
        </nav>
        <div class="tab-content" id="institutional-tab-content">
            <div class="tab-pane fade show active" id="mission-content" role="tabpanel" aria-labelledby="mission-tab" tabindex="0" data-language="{{ $language }}">
                {{ $college->mission->$language }}
            </div>
            <div class="tab-pane fade" id="vision-content" role="tabpanel" aria-labelledby="vision-tab" tabindex="0" data-language="{{ $language }}">
                {{ $college->vision->$language }}
            </div>
            <div class="tab-pane fade" id="values-content" role="tabpanel" aria-labelledby="values-tab" tabindex="0" data-language="{{ $language }}">
                {{ $college->principles->$language }}
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
