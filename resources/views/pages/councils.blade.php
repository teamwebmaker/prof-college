@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-bank"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.councils.title') }}</span>
        </h2>
        <div class="row">
            @foreach($councils as $council)
                <div class="col-12 mb-4">
                    <div class="card council-card">
                        <div class="card-header">
                            <p class="council-card-text">
                                <span class="text-red fw-bold" data-language="{{ $language }}">
                                    {{ __('static.pages.councils.first_name')}}:
                                </span>
                                <span data-language="{{ $language }}">{{ $council->first_name->$language }}</span>
                            </p>
                            <p class="council-card-text">
                                <span class="text-red fw-bold" data-language="{{ $language }}">
                                    {{ __('static.pages.councils.last_name')}}:
                                </span>
                                <span data-language="{{ $language }}">{{ $council->last_name->$language }}</span>
                            </p>
                            <p class="council-card-text">
                                <span class="text-red fw-bold" data-language="{{ $language }}">
                                    {{ __('static.pages.councils.representative')}}:
                                </span>
                                <span data-language="{{ $language }}">{{ $council->representative->$language }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
