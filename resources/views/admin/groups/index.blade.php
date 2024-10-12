@extends('layouts.dashboard')
@section('title', 'Groups List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($groups as $group)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ $group -> number}}
                        </h3>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('groups.edit', ['group' => $group, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-pencil-square"></i>
                            <span class="text-label">Edit</span>
                        </a>
                        <form method="POST" action="{{ route('groups.destroy', ['group' => $group, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ ჯგუფი?')">
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

