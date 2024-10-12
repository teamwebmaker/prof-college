@extends('layouts.master')
@section('title', $category -> title -> $language)

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-newspaper"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.section.articles.title') }} / {{$category -> title -> $language}}</span>
        </h2>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                    <x-article-component :article="$article" :language="$language"/>
                </div>
            @endforeach
        </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
@endsection
