@extends('layouts.master')

@section('title', __('static.pages.title'))

@section('styles')
<style>

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
