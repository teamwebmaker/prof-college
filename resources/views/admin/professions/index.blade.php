@extends('layouts.dashboard')
@section('title', 'Professions List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($professions as $profession)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <h2 class="card-header">
                        {{ $profession -> title -> ka }} ({{$profession -> type -> ka}})
                    </h2>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if($profession -> condition)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.condition') }} :</span>
                                    <span class="item-value">{{ $profession -> condition -> ka }}</span>
                                </li>
                            @endif
                            @if($profession -> level)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.level') }} :</span>
                                    <span class="item-value">{{ $profession -> level }}</span>
                                </li>
                            @endif
                            @if($profession -> credits)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.credits') }} :</span>
                                    <span class="item-value">{{ $profession -> credits }} {{__('static.pages.professions.credit')}}</span>
                                </li>
                            @endif
                            @if($profession -> duration)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.duration') }} :</span>
                                    <span class="item-value">{{ $profession -> duration  }} {{__('static.pages.professions.month')}}</span>
                                </li>
                            @endif
                            @if($profession -> custom_credits)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.custom_credits') }} :</span>
                                    <span class="item-value">{{ $profession -> custom_credits  }} {{__('static.pages.professions.credit')}}</span>
                                </li>
                            @endif
                            @if($profession -> custom_duration)
                                <li class="list-group-item fw-bold">
                                    <span class="item-key text-red">{{ __('static.pages.professions.custom_duration') }} :</span>
                                    <span class="item-value">{{ $profession -> custom_duration  }} {{__('static.pages.professions.month')}}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-between ">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('professions.edit', ['profession' => $profession, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('professions.destroy', ['profession' => $profession, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ პროფესია?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger d-flex gap-2">
                                <i class="bi bi-trash"></i>
                                <span class="text-label">Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $professions->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

