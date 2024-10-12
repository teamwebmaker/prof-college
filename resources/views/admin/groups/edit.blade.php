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
            <form method="POST"  action="{{ route('groups.update', ['group' => $group, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" class="form-control" name="number" placeholder="ნომერი" value="{{ $group -> number }}" required/>
                </div>
                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <input type="file" class="form-control" name="table" />
                        </div>
                        <div class="col">
                            <div class="ratio ratio-21x9">
                                <iframe src="{{ asset('docs/groups/tables' . $group -> table) }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="profession_id" required>
                        <option selected disabled>პროფესია</option>
                        @foreach($professions as $profession)
                            <option value="{{ $profession -> id }}" @selected($profession -> id == $group -> profession_id)>{{ $profession -> title -> ka }} ({{ $profession -> type -> ka }})</option>
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

