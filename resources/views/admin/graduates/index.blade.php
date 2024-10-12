@extends('layouts.dashboard')
@section('title', 'graduates List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($graduates as $graduated)
            @if($graduated -> image)
                <div class="col-6 mb-4">
                    <div class="card mb-3 graduated-card">
                        <div class="card-header bg-transparent p-0 border border-0">
                            <h4 class="section-title mb-4 text-red">
                                <span class="section-title-label pb-2 decor-border text-center">{{$graduated -> title }}</span>
                            </h4>
                        </div>
                        <div class="card-body bg-transparent p-0 mb-4 border border-0 w-100">
                            <img src="{{ asset('images/graduates/' .  $graduated -> image) }}" class="img-fluid graduate-image" alt="...">
                        </div>
                        <div class="card-footer d-flex justify-content-between w-100">
                            <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('graduates.edit', ['graduate' => $graduated, 'language' => app() -> getLocale()]) }}">
                                <i class="bi bi-pencil-square"></i>
                                <span class="text-label">Edit</span>
                            </a>
                            <form method="POST" action="{{ route('graduates.destroy', ['graduate' => $graduated, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ კუსრდამთავრებული?')">
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
            @else
                <div class="col-6 mb-4">
                    <div class="card  graduated-card">
                        <div class="card-header p-0 bg-transparent">
                            <h4 class="section-title mb-4 text-red text-center">
                                <span class="section-title-label pb-2 decor-border">{{$graduated -> title}}</span>
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <img src="{{ asset('images/graduates/' .  $graduated -> poster) }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="card-footer d-flex justify-content-between w-100">
                            <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('graduates.edit', ['graduate' => $graduated, 'language' => app() -> getLocale()]) }}">
                                <i class="bi bi-pencil-square"></i>
                                <span class="text-label">Edit</span>
                            </a>
                            <form method="POST" action="{{ route('graduates.destroy', ['graduate' => $graduated, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ კუსრდამთავრებული?')">
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
            @endif
        @endforeach
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            {!! $graduates->withQueryString()->links('pagination::bootstrap-5') !!}--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

@section('scripts')
    <script></script>
@endsection

