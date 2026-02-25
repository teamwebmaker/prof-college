@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.inclusive_education_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($inclusive_educations as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.one_year_action_plan_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($one_year_action_plan_reports as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.library_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($library_reports as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.miscellaneous_activity_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($miscellaneous_activity_reports as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.strategic_plan_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($strategic_plan_reports as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard-data"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.documents.section.college_activity_reports') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="program-content">
                <div class="authorization mb-4 catalog rounded p-2">
                    <div class="row">
                        @foreach($college_activity_reports as $doc)
                            <div class="col-md-4 mb-3">
                                <x-doc-component :doc="$doc" :language="$language"/>
                            </div>
                        @endforeach
                    </div>
                </div>
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
