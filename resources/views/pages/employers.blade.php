@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-people pb-2 fs-2"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.employers.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($employers as $employer)
                <div class="col-md-4 col-sm-6 mb-4">
                    <x-employer-component :employer="$employer" />
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $employers->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
