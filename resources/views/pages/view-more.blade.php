@extends('layouts.master')

@section('meta')
    @include('partials.share-meta')
@endsection

@section('title', $article->title->$language)

@section('styles')
<style>

</style>
@endsection
@section('main')
    <div class="container-xxl">
        <div class="row">
            <div class="col mb-4">
                <x-single-article-component :article="$article" :language="$language"/>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
@endsection
