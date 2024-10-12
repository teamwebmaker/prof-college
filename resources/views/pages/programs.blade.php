@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-card-list"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.programs.title') }}</span>
        </h2>
        <div class="catalog">
            <h4 class="section-title mb-4 text-red">
                <i class="bi bi-card-checklist"></i>
                <span class="section-title-label pb-2">{{ __('static.pages.programs.catalog') }}</span>
            </h4>
            <div class="row">
                <div class="col-md-4">
                    <a class="doc-link text-decoration-none" href="#" target="_blank">
                        <div class="card px-3 py-2 doc-card">
                            <h6 class="module-title d-flex align-items-center gap-2">
                                <i class="bi bi-filetype-pdf fs-3"></i>
                                <span class="module-title-label truncate">2023 წლის კატალოგი</span>
                            </h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="doc-link text-decoration-none" href="#" target="_blank">
                        <div class="card px-3 py-2 doc-card">
                            <h6 class="module-title d-flex align-items-center gap-2">
                                <i class="bi bi-filetype-pdf fs-3"></i>
                                <span class="module-title-label truncate">2022 წლის კატალოგი</span>
                            </h6>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="doc-link text-decoration-none" href="#" target="_blank">
                        <div class="card px-3 py-2 doc-card">
                            <h6 class="module-title d-flex align-items-center gap-2">
                                <i class="bi bi-filetype-pdf fs-3"></i>
                                <span class="module-title-label truncate">2021 წლის კატალოგი</span>
                            </h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="accordion program-accordion" id="accordionExample">
                <!-- ✨ TODO: start item  ✨-->
                <div class="accordion-item program-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapse-btn bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#modular" aria-expanded="true" aria-controls="modular">
                            <h5 class="module-title d-flex align-items-center gap-2">
                                <i class="bi bi-book fs-3"></i>
                                <span class="section-title-label">{{ __('static.pages.programs.current') }}</span>
                            </h5>
                        </button>
                    </h2>
                    <div id="modular" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body program-accordion-body">
                            <div class="row">
                                @foreach($programs as $program)
                                    <div class="col-lg-4 mb-3">
                                        <x-program-component :program="$program" :language="$language"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
{{--                <!-- ✨ TODO: end item  ✨-->--}}
{{--                <!-- ✨ TODO: start item  ✨-->--}}
{{--                <div class="accordion-item program-accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button collapse-btn bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#dual" aria-expanded="true" aria-controls="dual">--}}
{{--                            <h5 class="module-title d-flex align-items-center gap-2">--}}
{{--                                <i class="bi bi-book fs-3"></i>--}}
{{--                                <span class="section-title-label">{{ __('static.pages.programs.dual') }}</span>--}}
{{--                            </h5>--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="dual" class="accordion-collapse collapse" data-bs-parent="#accordionExample">--}}
{{--                        <div class="accordion-body program-accordion-body">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($dual as $program)--}}
{{--                                    <div class="col-lg-4 mb-3">--}}
{{--                                        <x-program-component :program="$program" :language="$language"/>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ✨ TODO: end item  ✨-->--}}
{{--                <!-- ✨ TODO: start item  ✨-->--}}
{{--                <div class="accordion-item program-accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button collapse-btn bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#integrated" aria-expanded="true" aria-controls="integrated">--}}
{{--                            <h5 class="module-title d-flex align-items-center gap-2">--}}
{{--                                <i class="bi bi-book fs-3"></i>--}}
{{--                                <span class="section-title-label">{{ __('static.pages.programs.integrated') }}</span>--}}
{{--                            </h5>--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="integrated" class="accordion-collapse collapse" data-bs-parent="#accordionExample">--}}
{{--                        <div class="accordion-body program-accordion-body">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($integrated as $program)--}}
{{--                                    <div class="col-lg-4 mb-3">--}}
{{--                                        <x-program-component :program="$program" :language="$language"/>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ✨ TODO: end item  ✨-->--}}
{{--                <!-- ✨ TODO: start item  ✨-->--}}
{{--                <div class="accordion-item program-accordion-item">--}}
{{--                    <h2 class="accordion-header">--}}
{{--                        <button class="accordion-button collapse-btn bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#short_term" aria-expanded="true" aria-controls="short_term">--}}
{{--                            <h5 class="module-title d-flex align-items-center gap-2">--}}
{{--                                <i class="bi bi-book fs-3"></i>--}}
{{--                                <span class="section-title-label">{{ __('static.pages.programs.short-term') }}</span>--}}
{{--                            </h5>--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="short_term" class="accordion-collapse collapse" data-bs-parent="#accordionExample">--}}
{{--                        <div class="accordion-body program-accordion-body">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($short_term as $program)--}}
{{--                                    <div class="col-lg-4 mb-3">--}}
{{--                                        <x-program-component :program="$program" :language="$language"/>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- ✨ TODO: end item  ✨-->--}}
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
