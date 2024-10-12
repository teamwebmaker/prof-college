@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-mortarboard"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.graduates.title') }}</span>
        </h2>
        <div class="row">
            @foreach($graduates as $graduated)
                @if($graduated -> image)
                    <div class="col-12 mb-4">
                        <div class="card mb-3 graduated-card">
                            <div class="card-header bg-transparent p-0 border border-0">
                                <h4 class="section-title mb-4 text-red">
                                    <span class="section-title-label pb-2 decor-border text-center">{{$graduated -> title }}</span>
                                </h4>
                            </div>
                            <div class="card-body bg-transparent p-0 mb-4 border border-0 w-100">
                                <img src="{{ asset('images/graduates/' .  $graduated -> image) }}" class="img-fluid graduate-image" alt="...">
                            </div>
                            <div class="card-footer bg-transparent border border-0">
                                <p class="card-text">{{ $graduated -> description }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 mb-4">
                        <div class="card  graduated-card">
                            <div class="card-header p-0 bg-transparent">
                                <h4 class="section-title mb-4 text-red text-center">
                                    <span class="section-title-label pb-2 decor-border">{{$graduated -> title}}</span>
                                </h4>
                            </div>
                            <div class="card-body p-0">
                                <img src="{{ asset('images/graduates/' .  $graduated -> poster) }}" class="img-fluid rounded-start" alt="...">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $graduates->withQueryString()->links('pagination::bootstrap-5') !!}
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
