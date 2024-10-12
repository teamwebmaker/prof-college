@extends('layouts.dashboard')
@section('title', 'Visitors List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($visitors as $visitor)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="list-group list-group-flush">
                            @if($visitor -> region)
                                <li class="list-group-item">
                                    <span class="fw-bolder">ქალაქი/რეგიონი: </span>
                                    {{ $visitor -> region }}
                                </li>
                            @endif
                             @if($visitor -> district)
                                    <li class="list-group-item">
                                        <span class="fw-bolder">რაიონი: </span>
                                        {{ $visitor -> district }}
                                    </li>
                             @endif
                            <li class="list-group-item">
                                <span class="fw-bolder">სკოლა: </span>
                               {{ $visitor -> school }}
                            </li>
                            <li class="list-group-item">
                                <span>ტელეფონი: </span>
                                {{ $visitor -> phone }}
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <form method="POST" action="{{ route('visitors.destroy', ['visitor' => $visitor, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ ვიზიტორი?')">
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

