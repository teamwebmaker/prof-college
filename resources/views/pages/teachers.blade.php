@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
<style>
    /* Teacher Card Split Layout - No Responsive CSS */
    .teacher-card-split {
        --light-red: hsl(1 95% 30%);
        --dark-red: hsl(1 60% 45%);
        --gold: hsl(43 55% 50%);
        --white: hsl(0 0% 100%);
        --light-gray: hsl(28 7% 87%);
        --dark-text: hsl(0 0% 20%);

        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px hsla(0, 0%, 0%, 0.1);
        transition: all 0.3s ease;
        background: var(--white);
    }

    .teacher-card-split:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px hsla(0, 0%, 0%, 0.15);
    }

    /* Image Column */
    .teacher-image-col {
        position: relative;
    }

    .teacher-image-container {
        width: 100%;
        height: 100%;
    }

    .teacher-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .teacher-card-split:hover .teacher-image {
        transform: scale(1.03);
    }

    .teacher-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background: linear-gradient(to top, hsla(0, 0%, 0%, 0.6) 0%, hsla(0, 0%, 0%, 0) 100%);
    }

    /* Content Column */
    .teacher-content-col {
        display: flex;
        align-items: center;
        padding: 1.5rem;
    }

    .teacher-content {
        width: 100%;
    }

    .teacher-info-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 1rem;
    }

    .teacher-info-row:last-child {
        margin-bottom: 0;
    }

    .teacher-label {
        color: var(--dark-red);
        font-weight: 700;
        font-size: 0.9rem;
        min-width: 80px;
    }

    .teacher-value {
        color: var(--dark-text);
        font-weight: 500;
        font-size: 1rem;
        flex: 1;
    }
</style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-person-bounding-box"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.teachers.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            @foreach($teachers as $teacher)
                    <div class=" col-md-6 mb-4">
                        <x-teacher-component :teacher="$teacher" language="ka"/>
                    </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $teachers->withQueryString()->links('pagination::bootstrap-5') !!}
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
