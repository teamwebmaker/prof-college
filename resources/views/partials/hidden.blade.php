<aside class="aside-nav">
    <ul class="list-group list-group-flush rounded bg-transparent gap-2">
        <li class="list-group-item p-0  bg-transparent border border-0">
            <a type="button" href="{{ route('tables', ['language' => app()->getLocale()])}}"
                class="btn bg-dark-red text-white aside-btn" data-bs-toggle="tooltip" data-bs-placement="left"
                data-bs-title="{{ __('static.pages.tables.title') }}" title="ცხრილები" data-language="{{$language}}">
                <i class="bi bi-newspaper fs-4"></i>
            </a>
        </li>
        <li class="list-group-item p-0 bg-transparent border border-0">
            <button type="button" class="btn bg-dark-red text-white aside-btn" data-bs-toggle="tooltip"
                data-bs-placement="left" data-bs-title="{{ __('static.section.aside.vote') }}" id="voting-toggle"
                onclick="showModal('vote')" title="შეფასება" data-language="{{$language}}">
                <i class="bi bi-card-checklist fs-4"></i>
            </button>
        </li>
        <li class="list-group-item p-0 bg-transparent  border border-0">
            <a href="https://geolibrary.byethost3.com/gldani/opac/index.php" 
            class="btn bg-dark-red text-white aside-btn" 
            target="_blank" 
            data-bs-toggle="tooltip" 
            data-bs-placement="left" 
            data-bs-title="ბიბლიოთეკა" 
            data-language="ka"
            aria-label="Library">
            <i class="bi bi-book fs-4"></i>
        </a>
        </li>
        <li class="list-group-item p-0 bg-transparent  border border-0">
            <a class="btn bg-dark-red text-white aside-btn" 
                data-fancybox 
                data-type="iframe" 
                data-preload="false" 
                href="{{ asset('docs/static/announcement.pdf') }}" 
                target="_blank" 
                data-bs-toggle="tooltip" 
                data-bs-placement="left" 
                data-bs-title="Announcements" 
                data-language="ka"
                aria-label="View current announcements (PDF document, opens in a new window)"> 
                <i class="bi bi-megaphone fs-4"></i>
            </a>
        </li>
    </ul>
</aside>

<!-- start program list template -->
<template id="programsList">
    <div class="accordion" id="programsListingTab">
        @foreach($professions as $profession)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button program-accordion-button @if(!$loop->first) collapsed @endif"
                        type="button" data-bs-toggle="collapse" data-bs-target="#programsListingTab-{{$profession->id}}"
                        aria-expanded="@if($loop->first) true @else false @endif"
                        aria-controls="programsListingTab-{{ $profession->id }}" data-language="{{$language}}">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        {{ $profession->title->$language }}
                                @if ($profession->type->$language)
                                    ({{ $profession->type->$language }})
                                @endif
                    </button>
                </h2>
                <div id="programsListingTab-{{$profession->id}}"
                    class="accordion-collapse collapse @if($loop->first) show @endif" data-bs-parent="#programsListingTab">
                    <div class="accordion-body">
                        <ul class="list-group list-group-flush">
                            @if($profession->condition)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.condition') }} :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->condition->$language }}</span>
                                </li>
                            @endif
                            @if($profession->level)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.level') }} :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->level }}</span>
                                </li>
                            @endif
                            @if($profession->credits)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.credits') }} :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->credits }}
                                        {{__('static.pages.professions.credit')}}</span>
                                </li>
                            @endif
                            @if($profession->duration)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.duration') }} :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->duration  }}
                                        {{__('static.pages.professions.month')}}</span>
                                </li>
                            @endif
                            @if($profession->custom_credits)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.custom_credits') }} :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->custom_credits  }}
                                        {{__('static.pages.professions.credit')}}</span>
                                </li>
                            @endif
                            @if($profession->custom_duration)
                                <li class="list-group-item fw-bold" data-language="{{$language}}">
                                    <span class="item-key text-red" data-language="{{$language}}">{{ __('static.pages.professions.custom_duration') }}
                                        :</span>
                                    <span class="item-value" data-language="{{$language}}">{{ $profession->custom_duration  }}
                                        {{__('static.pages.professions.month')}}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</template>
<!-- end program list template -->

<!-- start vote  template -->
<template id="vote">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card vote-card">
                    <div class="card-header bg-dark-red">
                        <h4 class="text-center text-white fw-bold" data-language="{{$language}}">
                            {{ __('static.section.vote.title') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('votes.store', ['language' => app()->getLocale()]) }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6 mb-3 d-flex justify-content-center">
                                    <input type="radio" class="btn-check" name="vote" id="high" value="high"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-success d-block w-100" for="high" data-language="{{$language}}">
                                        <span data-language="{{$language}}">{{ __('static.section.vote.high') }}</span>
                                        <i class="bi bi-emoji-sunglasses-fill"></i>
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3 d-flex justify-content-center">
                                    <input type="radio" class="btn-check" name="vote" id="middle" value="middle"
                                        autocomplete="off">
                                    <label class="btn btn-outline-warning d-block w-100" for="middle" data-language="{{$language}}">
                                        <span data-language="{{$language}}">{{ __('static.section.vote.middle') }}</span>
                                        <i class="bi bi-emoji-smile-fill"></i>
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3 d-flex justify-content-center">
                                    <input type="radio" class="btn-check" name="vote" id="low" value="low"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger d-block w-100" for="low" data-language="{{$language}}">
                                        <span data-language="{{$language}}">{{ __('static.section.vote.low') }}</span>
                                        <i class="bi bi-emoji-smile-upside-down-fill"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-1">
                                <button type="submit"
                                    class="btn bg-dark-red w-100 text-white vote-btn" data-language="{{$language}}">{{ __('static.vote.send') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<!-- end program list template -->

<!-- start announcement template-->
<template id="announcement">
    <div class="ratio ratio-21x9">
        <iframe src="{{ asset('assets/pdf/announcement_2023.pdf') }}" title="YouTube video" allowfullscreen data-language="{{$language}}"></iframe>
    </div>
</template>
<!-- start announcement template-->

<!-- start search template -->
<template id="search">
    <div class="row justify-content-center">
        <div class="col-sm-6 d-flex justify-content-center">
            <form class="d-flex w-100" role="search" action="{{ route('home', ['language' => app()->getLocale()])}}">
                <input class="form-control search-bar w-100 px-2" type="search" placeholder="Search" aria-label="Search"
                    name="search" data-language="{{$language}}">
                <button class="btn text-white fs-5" type="submit" data-language="{{$language}}"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</template>
<!-- end search template -->

<!-- Start Modal -->
<div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="pageModalLabel" aria-hidden="false"
    style="--bs-modal-width:1200px">
    <div class="modal-dialog">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-language="{{$language}}"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<!-- End Modal -->
