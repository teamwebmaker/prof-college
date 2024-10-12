@extends('layouts.dashboard')
@section('title', 'სლაიდის შექმნა')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('slides.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="file" class="form-control" name="slide"  required/>
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

