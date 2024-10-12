@extends('layouts.dashboard')
@section('title', 'Employers List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($employers as $employer)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header p-0">
                        <img src="{{ asset('images/employers/' . $employer -> image) }}" class="img-fluid rounded-start article-image" alt="...">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title truncate" title="{{ $employer -> title }}">
                            {{ $employer -> title}}
                        </h3>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('employers.edit', ['employer' => $employer, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('employers.destroy', ['employer' => $employer, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ დამსაქმებელი?')">
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
            {!! $employers->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

