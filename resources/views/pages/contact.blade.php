@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>
    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-person-lines-fill"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.contact.title') }}</span>
        </h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @session('success')
        <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ $value }}
        </div>
        @endsession
        <div class="row">
            <div class="col-lg-12 mb-4">
                <form method="POST" action="{{ route('contacts.store', ['language' => app() -> getLocale()]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="text" class="form-control  form-field" name="full_name" placeholder="{{ __('static.pages.contact.form_fields.full_name') }}"  />
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="text" class="form-control form-field" name="subject" placeholder="{{ __('static.pages.contact.form_fields.subject') }}"  />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="email" class="form-control form-field" name="email" placeholder="{{ __('static.pages.contact.form_fields.email') }}"  />
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="mb-3">
                                <input type="tel" id="phone" name="phone"  class="form-control form-field"  placeholder="{{ __('static.pages.contact.form_fields.phone') }}"  />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control form-field"  rows="5" name="message"  placeholder="{{ __('static.pages.contact.form_fields.message') }}"></textarea>
                    </div>
                    <button type="submit" class="btn view-more-btn">{{ __('static.pages.contact.send_message') }}</button>
                </form>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190570.98345666463!2d44.64195469052535!3d41.72760440547997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cd7e64f626b%3A0x61d084ede2576ea3!2sTbilisi!5e0!3m2!1sen!2sge!4v1705256468146!5m2!1sen!2sge" title="Location" allowfullscreen></iframe>
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
