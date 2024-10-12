@extends('layouts.dashboard')
@section('title', 'graduates List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($documents as $document)
            <div class="col-6 mb-4">
                    <div class="card  graduated-card">
                        <div class="card-header p-0 bg-transparent">
                            <h4 class="section-title mb-4 text-red text-center">
                                <span class="section-title-label pb-2 decor-border">{{$document -> title -> ka}}</span>
                            </h4>
                        </div>
                        <div class="card-footer d-flex justify-content-between w-100">
                            <form method="POST" action="{{ route('documents.destroy', ['document' => $document, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ კუსრდამთავრებული?')">
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
                {!! $documents->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
@endsection

@section('scripts')
    <script></script>
@endsection

