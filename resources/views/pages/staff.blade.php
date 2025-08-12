@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')

<style>
    .staff-card {
        --primary-color: var(--dark-red);
        --text-color: #2b2d42;
        --bg-color: var(--white);
        --transition-speed: 0.3s;

        width: 100%;
        height: 100%;
        border-radius: 4px;
        background: var(--bg-color);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        transition: transform var(--transition-speed) ease;
        display: flex;
        flex-direction: column;
    }

    .staff-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    .staff-card__image-container {
        height: 70%;
        position: relative;
        overflow: hidden;
    }

    .staff-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .staff-card:hover .staff-card__image {
        transform: scale(1.05);
    }

    .staff-card__overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 40%);
        opacity: 0;
        transition: opacity var(--transition-speed) ease;
    }

    .staff-card:hover .staff-card__overlay {
        cursor: default;
        opacity: 1;
    }

    .staff-card__content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .staff-card__name {
        margin: 0;
        color: var(--text-color);
        font-size: 1.25rem;
        font-weight: 600;
        transition: color var(--transition-speed) ease;
    }

    .staff-card:hover .staff-card__name {
        cursor: default;
        color: var(--primary-color);
    }

    .staff-card__position {
        cursor: default;
        margin: 8px 0 0;
        color: var(--light-grey);
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .staff-card__social {
        margin-top: 12px;
        opacity: 0;
        transform: translateY(10px);
        transition: all var(--transition-speed) ease;
    }

    .staff-card:hover .staff-card__social {
        cursor: default;
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endsection

@section('main')
    <div class="container-xxl">

        <!-- Administration Section -->
        <h2 class="section-title text-red mb-3">
            <i class="bi bi-person-badge"></i> {{-- Icon for administration --}}
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.staff.administration') }}</span>
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
            <span class="section-title-label pb-1 decor-border" data-language="{{ $language }}">{{ __('static.pages.staff.management') }}</span>
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
