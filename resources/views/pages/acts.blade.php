@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')

@endsection

@section('main')
    <div class="container-xxl">
        <!-- Page Header -->
        <h2 class="section-title mb-4 text-red d-flex align-items-center">
            <i class="bi bi-briefcase fs-2"></i>
            <span class="section-title-label pb-2 decor-border">
                {{ __('static.pages.documents.legislation.legal_acts') }}
            </span>
        </h2>

        <!-- Legislative Docs -->
        <div class="mb-5 catalog rounded p-3">
            <h5 class="text-red pb-2 ">
                {{ __('static.pages.documents.legislation.sub_title_leg') }}
            </h5>
            <div class="row">
                @foreach($legislative_docs as $doc)
                    <div class="col-md-4 mb-3">
                        <x-doc-component :doc="$doc" :language="$language" />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Subordinate Docs -->
        <div class="mb-5 catalog rounded p-3">
            <h5 class="text-red pb-2">
                {{ __('static.pages.documents.legislation.sub_title_sub') }}
            </h5>
            <div class="row">
                @foreach($subordinate_docs as $doc)
                    <div class="col-md-4 mb-3">
                        <x-doc-component :doc="$doc" :language="$language" />
                    </div>
                @endforeach
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
