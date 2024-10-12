@extends('layouts.dashboard')
@section('title', 'Vacancies List')
@section('main')
    @session('error')
    <div class="alert alert-danger" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($vacancies as $vacancy)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <span>{{ $vacancy -> title }}</span>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <form method="POST" action="{{ route('vacancies.destroy', ['vacancy' => $vacancy, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ ვაკანსია?')">
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

