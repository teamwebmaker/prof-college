@extends('layouts.dashboard')
@section('title', 'ვაკანსიის შექმნა')
@section('main')
    @session('error')
    <div class="alert alert-danger" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('vacancies.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" placeholder="ვაკანსიის დასახელება" required/>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="file" required />
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

