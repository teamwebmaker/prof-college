@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <div class="container">
            <h2 class="section-title mb-4 text-red">
                <i class="bi bi-file-earmark-pdf"></i>
                <span class="section-title-label pb-2 decor-border">{{ __('static.pages.documents.learning_process.title') }}</span>
            </h2>
            <div class="row">
                @foreach($docs as $doc)
                        <div class="col-md-4 mb-3">
                            <x-doc-component :doc="$doc" :language="$language"/>
                        </div>
                @endforeach
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
