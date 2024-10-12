@extends('layouts.dashboard')
@section('title', 'Articles List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($slides as $slide)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header p-0">
                        <div class="ratio ratio-16x9">
                            <img src="{{ asset('images/slides/' . $slide -> slide) }}"  />
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <form method="POST" action="{{ route('slides.destroy', ['slide' => $slide, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ სლაიდი?')">
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

