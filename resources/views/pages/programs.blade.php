@extends('layouts.master')
@section('title', __('static.pages.title'))

@section('styles')
    <style>
        /* Add your custom styles here */
    </style>
@endsection

@section('main')
    <div class="container-xxl">
        <h2 class="section-title mb-4 text-red">
            <i class="bi bi-clipboard2-pulse"></i>
            <span class="section-title-label pb-2 decor-border" data-language="{{ $language }}">{{ __('static.pages.programs.title') }}</span>
        </h2>

        <div class="catalog">
            <h4 class="section-title mb-4 text-red">
                <i class="bi bi-card-checklist"></i>
                <span class="section-title-label pb-2" data-language="{{ $language }}">{{ __('static.pages.programs.catalog') }}</span>
            </h4>
            <div class="row">
                @foreach($catalogues as $catalogue)
                    @php
                        $filePath = $catalogue->file->$language ?? null;
                        $isDisabled = is_null($filePath);
                    @endphp
                    <div class="col-md-4 mb-2">
                        <a
                            class="doc-link text-decoration-none {{ $isDisabled ? 'disabled opacity-75 cursor-default' : '' }}"
                            href="{{ $isDisabled ? '#' : asset('docs/programs/' . $filePath) }}"
                            target="{{ $isDisabled ? '_self' : '_blank' }}">
                            <div
                                class="card px-3 py-2 doc-card"
                                @if (!$isDisabled)
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="{{ $catalogue->title->$language }}"
                                @endif
                            >
                                <h6 class="module-title d-flex align-items-center gap-2">
                                    <i class="bi bi-filetype-pdf fs-3"></i>
                                    <span class="module-title-label truncate" data-language="{{ $language }}">{{ $catalogue->title->$language }}</span>
                                </h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row justify-content-center catalog p-0">
            <div class="accordion p-0" id="programsListTabs">
                @foreach($professions as $profession)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button program-accordion-button @if(!$loop->first) collapsed @endif"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#programsListTab-{{$profession->id}}"
                                aria-expanded="@if($loop->first) true @else false @endif"
                                aria-controls="programsListTab-{{ $profession->id }}"
                                data-language="{{ $language }}"
                            >
                                <i class="bi bi-mortarboard-fill me-2"></i>
                                {{ $profession->title->$language }}
                                @if (!in_array($profession->type->$language, ['მოდულური', 'modular']))
                                    ({{ $profession->type->$language }})
                                @endif
                            </button>
                        </h2>
                        <div
                            id="programsListTab-{{$profession->id}}"
                            class="accordion-collapse collapse @if($loop->first) show @endif"
                            data-bs-parent="#programsListTabs"
                        >
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    @if($profession->condition)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.condition') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->condition->$language }}</span>
                                        </li>
                                    @endif
                                    @if($profession->level)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.level') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->level }}</span>
                                        </li>
                                    @endif
                                    @if($profession->credits)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.credits') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->credits }} {{ __('static.pages.professions.credit') }}</span>
                                        </li>
                                    @endif
                                    @if($profession->duration)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.duration') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->duration }} {{ __('static.pages.professions.month') }}</span>
                                        </li>
                                    @endif
                                    @if($profession->custom_credits)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.custom_credits') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->custom_credits }} {{ __('static.pages.professions.credit') }}</span>
                                        </li>
                                    @endif
                                    @if($profession->custom_duration)
                                        <li class="list-group-item fw-bold">
                                            <span class="item-key text-red" data-language="{{ $language }}">{{ __('static.pages.professions.custom_duration') }} :</span>
                                            <span class="item-value" data-language="{{ $language }}">{{ $profession->custom_duration }} {{ __('static.pages.professions.month') }}</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
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
