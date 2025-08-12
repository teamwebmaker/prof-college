@extends('layouts.master')

@section('title', __('static.pages.pdf_view') . '/' . $fileName)

@section('styles')
    <style>

    </style>
@endsection

@section('main')
  <div class="pdf-viewer-container vh-100 d-flex flex-column bg-transparent">
    <iframe
      src="{{ asset('docs/static/' . $fileName) }}#view=FitH&toolbar=0&pagemode=none"
      class="w-100 h-100 border-0 flex-grow-1 bg-transparent"
      allowfullscreen
    ></iframe>
  </div>
@endsection

@section('scripts')
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection
