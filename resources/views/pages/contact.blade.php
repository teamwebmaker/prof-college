@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>
    .form-check-input:checked {
        background-color: var(--dark-red) !important;
        border-color: var(--dark-red) !important;
    }

    .form-check-input:focus {
        border-color: hsl(1, 60%, 65%) !important;
        box-shadow: 0 0 0 .25rem hsla(1, 60%, 45%, 0.3) !important;
    }

    /* Contact Info Styling */
    .contact-info-block {
        background: var(--light-gray-alt);
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px hsla(0, 0%, 0%, 0.08);
    }

    .contact {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1rem;
        position: relative;
        padding-left: 2rem;
        color: var(--dark-red);
        font-weight: 500;
    }

    .contact:last-child {
        margin-bottom: 0;
    }

    .contact::before {
        content: var(--icon);
        font-family: "bootstrap-icons";
        position: absolute;
        left: 0;
        font-size: 1.2rem;
        color: var(--gold);
    }
    </style>
@endsection

@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-person-lines-fill"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">
                {{ __('static.pages.contact.title') }}
            </span>
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li data-language="{{ $language }}">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @session('success')
        <div class="alert alert-success" role="alert"  
                x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 3000)" 
                data-language="{{ $language }}">
            {{ $value }}
        </div>
        @endsession

        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-12 mb-4">
                <form method="POST" action="{{ route('contacts.store', ['language' => app() -> getLocale()]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="text" class="form-control form-field" name="full_name" placeholder="{{ __('static.pages.contact.form_fields.full_name') }}" data-language="{{ $language }}" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="text" class="form-control form-field" name="subject" placeholder="{{ __('static.pages.contact.form_fields.subject') }}" data-language="{{ $language }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="email" class="form-control form-field" name="email" placeholder="{{ __('static.pages.contact.form_fields.email') }}" data-language="{{ $language }}" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="tel" id="phone" name="phone" class="form-control form-field" placeholder="{{ __('static.pages.contact.form_fields.phone') }}" data-language="{{ $language }}" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control form-field" rows="5" name="message" placeholder="{{ __('static.pages.contact.form_fields.message') }}" data-language="{{ $language }}"></textarea>
                    </div>

                    <!-- Consent Checkbox -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="consentCheck" name="consent" required>
                        <label class="form-check-label text-red" for="consentCheck" style="cursor: pointer; font-size: 0.8rem;" data-language="{{ $language }}">
                            {{ __('static.pages.contact.consent_label') }}
                        </label>
                    </div>

                    <button type="submit" class="btn view-more-btn" data-language="{{ $language }}">
                        {{ __('static.pages.contact.send_message') }}
                    </button>
                </form>
            </div>

            <!-- Map -->
            <div class="col-lg-12 mb-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190570.98345666463!2d44.64195469052535!3d41.72760440547997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cd7e64f626b%3A0x61d084ede2576ea3!2sTbilisi!5e0!3m2!1sen!2sge!4v1705256468146!5m2!1sen!2sge" title="Location" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-12">
                <div class="contact-info-block">
                    <span class="contact" style="--icon: '\f3e8'" data-language="ka">
                        ქ. თბილისი, ილია ვეკუას ქუჩა, №44
                    </span>
                    <a class="contact" href="tel:0322140314" style="--icon: '\f5c1'">
                        <span data-language="ka">(032) 2-140-314</span>
                    </a>
                    <a class="contact" href="tel:0322140315" style="--icon: '\f5c1'">
                        <span data-language="ka">(032) 2-140-315</span>
                    </a>
                    <a class="contact" href="mailto:profgldaniedu@gmail.com" style="--icon: '\f32f'">
                        <span data-language="ka">profgldaniedu@gmail.com</span>
                    </a>
                </div>
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
