@extends('layouts.dashboard')
@section('title', 'დამსაქმებლის განახლება')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('employers.update', ['employer' => $employer, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" placeholder="სახელი" value="{{ $employer -> title }}" required/>
                </div>
                <div class="row">
                    <div class="col-8">
                        <input type="file" class="form-control" name="image" placeholder="სურათი" />
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('images/employers/' . $employer -> image) }}" class="w-25"/>
                    </div>
                </div>
                <div class="mb-3">
                    @if($employer -> url)
                        <input type="url" class="form-control" name="url" placeholder="ლინკი" value="{{ $employer -> url }}" />
                    @else
                        <input type="url" class="form-control" name="url" placeholder="ლინკი" />
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

