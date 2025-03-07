@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>

    </style>
@endsection
@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-file-earmark-pdf"></i>
            <span class="section-title-label pb-2 decor-border">{{ __('static.pages.documents.mission.title') }}</span>
        </h2>
        <div class="row justify-content-center">
            <div class="accordion program-accordion" id="accordionExample">
                <!-- ✨ TODO: start item  ✨-->
                <div class="accordion-item program-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapse-btn bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#legislation" aria-expanded="true" aria-controls="legislation">
                            <h5 class="module-title d-flex align-items-center gap-2">
                                <i class="bi bi-briefcase fs-3"></i>
                                {{--                                <span class="section-title-label">{{ __('static.pages.documents.activities.title') }}</span>--}}
                            </h5>
                        </button>
                    </h2>
                    <div id="legislation" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body program-accordion-body">
                            <div class="authorization mb-5 border border-warning-subtle rounded p-2">
                                <div class="row">
                                    @foreach($docs as $doc)
                                        <div class="col-md-4 mb-3">
                                            <x-doc-component :doc="$doc" :language="$language"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
