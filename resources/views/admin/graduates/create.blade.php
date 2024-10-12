@extends('layouts.dashboard')
@section('title', 'კურსდამმთავრებულის შექმნა')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('graduates.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" placeholder="სახელი" required/>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">სურათი</label>
                    <input class="form-control" type="file" id="formFile" name="image" />
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">პოსტერი</label>
                    <input class="form-control" type="file" id="formFile" name="poster" />
                </div>
                <div class="mb-3">
                    <textarea  class="form-control" rows="5" name="description" placeholder="აღწერა"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

