<!doctype html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body data-languge="ka">
<div class="wrapper">
    @include('partials.header')
    @include('partials.slide')
    <div class="container-xxl py-4">
        <div class="row">
            <div class="col-lg-8">
                <main>
                    @yield('main')
                </main>
            </div>
            <div class="col-lg-4">
                <aside>
                    @include('partials.aside')
                </aside>
            </div>
        </div>
    </div>
    @include('partials.partners')
    @include('partials.footer')
</div>

@include('partials.hidden')
<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script  src="{{ asset('scripts/app.js') }}"></script>
@yield('scripts')
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollegeOrUniversity",
    "name": "{{ __('static.pages.title') }}",
    "url": "{{ url()->current() }}",
    "logo": "{{ asset('images/themes/prof-gldani-icon.png') }}",
    "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+995591220608",
    "contactType": "customer service"
    },
    "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ __('static.contact.address') }}",
    "addressLocality": "Tbilisi",
    "addressCountry": "GE"
    }
}
</script>
@endpush
</body>
</html>
