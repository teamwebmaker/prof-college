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
@push('structured-data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ url()->current() }}"
  },
  "headline": "{{ $article->title->$language }}",
  "image": "{{ asset('images/articles/' . $article->image) }}",
  "datePublished": "{{ $article->created_at->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "author": {
    "@type": "Organization",
    "name": "{{ __('static.pages.title') }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ __('static.pages.title') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/themes/prof-gldani-icon.png') }}"
    }
  },
  "description": "{{ Str::substr($article->description->$language, 0, 150) }}"
}
</script>
@endpush
@endsection
