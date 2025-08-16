@extends('layouts.dashboard')
@section('title', 'Partners List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($partners as $partner)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header p-0">
                        <img src="{{ asset('images/partners/' . $partner -> image) }}" class="img-fluid" alt="...">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title truncate" title="{{ $partner -> title }}">
                            {{ $partner -> title}}
                        </h3>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('partners.edit', ['partner' => $partner, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('partners.destroy', ['partner' => $partner, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ პარტნიორი?')">
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
@endsection

@section('scripts')
    <script></script>
@endsection

