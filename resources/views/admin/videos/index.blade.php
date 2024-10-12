@extends('layouts.dashboard')
@section('title', 'Videos List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($videos as $video)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header p-0">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $video -> url }}" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title truncate" title="{{ $video -> title -> ka }}">
                            {{ $video -> title -> ka }}
                        </h3>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('videos.edit', ['video' => $video, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('videos.destroy', ['video' => $video, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ პროექტი?')">
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
            {!! $videos->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

