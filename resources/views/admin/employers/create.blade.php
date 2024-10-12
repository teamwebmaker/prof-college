@extends('layouts.dashboard')
@section('title', 'დამსაქმებლის შექმნა')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('employers.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" placeholder="სახელი" required/>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="image" placeholder="სურათი" />
                </div>
                <div class="mb-3">
                    <input type="url" class="form-control" name="url" placeholder="ლინკი" />
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

