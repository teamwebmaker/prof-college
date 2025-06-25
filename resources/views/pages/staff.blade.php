@extends('layouts.master')
@section('title', __('static.pages.title'))



@section('main')
    <div class="container-xxl">

        <!-- Administration Section -->
        <h2 class="section-title text-red mb-3">
            <i class="bi bi-person-badge"></i> {{-- Icon for administration --}}
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.staff.administration') }}</span>
        </h2>

        <div class="row justify-content-center g-4">
            @foreach($administrations as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm h-100 border-0">
                        <x-staff-component :staff="$item" :language="$language" />
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Management Section -->
        <h2 class="section-title text-red mt-5  mb-3">
            <i class="bi bi-people"></i> {{-- Icon for management --}}
            <span class="section-title-label pb-1 decor-border">{{ __('static.pages.staff.management') }}</span>
        </h2>

        <div class="row justify-content-center g-4">
            @foreach($managements as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm h-100 border-0">
                        <x-staff-component :staff="$item" :language="$language" />
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