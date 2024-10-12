@extends('layouts.dashboard')
@section('title', 'Gallery List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($galleries as $gallery)
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title truncate">
                            {{ $gallery -> title -> ka}}
                        </h3>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('galleries.edit', ['gallery' => $gallery, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('galleries.destroy', ['gallery' => $gallery, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ ადმინისტრაციის წევრი?')">
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
            {!! $galleries->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

