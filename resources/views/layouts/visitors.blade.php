<!doctype html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<style>
    .aside-btn {
        display: none;
    }

    .data-field{
        color: var(--dark-red) !important;
    }
</style>
<body data-languge="ka">
<div class="wrapper">
    <div class="container-xxl py-4 pt-0">
        @include('partials.sub-slide')
    </div>
    <div class="container-xxl py-4">
        <h2 class="py-3 text-center text-red">სტუმრად კოლეჯში</h2>
        @if ($errors->any())
            <div class="col-lg-6">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @session('success')
        <div class="col-lg-6">
            <div class="alert alert-success w-50" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                {{ $value }}
            </div>
        </div>
        @endsession
        <div class="row py-2">
            <div class="col-lg-6">
                <div class="text-box">
                    <div class="ratio ratio-4x3 ">
                        <iframe src="{{ asset('docs/static/visiting-college.pdf') }}" title="Visiting College"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card p-4 h-100 form-card">
                    <form method="POST"  action="{{ route('visitors.store',['language' => app() -> getLocale()]) }}" >
                        @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control form-field"  placeholder="რეგიონი / ქალაქი" name="region" />
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control form-field"  placeholder="რაიონი" name="district" />
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control form-field"  placeholder="სკოლა" name="school" required />
                        </div>
                        <div class="mb-4">
                            <input type="date" class="form-control form-field data-field" placeholder="თვე/დღე/წელი" name="date" pattern="\d{2}/\d{2}/\d{4}" required />
                        </div>
                        <div class="mb-4">
                            <input type="number" class="form-control form-field"  placeholder="საკონტაქტო პირის ტელეფონი" name="phone" required />
                        </div>
                        <button type="submit" class="btn view-more-btn">გაგზავნა</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</div>

@include('partials.hidden')
<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    const swiperSub = {
        slidesPerView: 1,
        speed: 2000,
        autoplay: {
            delay: 3000,
        },
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            700: {
                slidesPerView: 1
            }
        }
    }
    const swiperSliderInit = new Swiper(".swiper-sub", swiperSub );

</script>
<script  src="{{ asset('scripts/app.js') }}"></script>
@yield('scripts')
</body>
</html>
