@extends('layouts.dashboard')
@section('title', 'ჯგუფის შექმნა')
@section('main')
    @session('error')
    <div class="alert alert-danger" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('groups.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="number" placeholder="ნომერი" required/>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="table" required />
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="profession_id" required>
                        <option selected disabled>პროფესია</option>
                        @foreach($professions as $profession)
                            <option value="{{ $profession -> id }}">{{ $profession -> title -> ka }} ({{ $profession -> type -> ka }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

