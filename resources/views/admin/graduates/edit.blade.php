@extends('layouts.dashboard')
@section('title', 'კურსდამმთავრებულის განახლება')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('graduates.update', ['graduate' => $graduate, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" placeholder="სახელი" value="{{ $graduate -> title }}" required/>
                </div>
                <div class="mb-3">
                    @if($graduate -> image)
                        <div class="row align-items-center">
                            <div class="col">
                                <label for="formFile" class="form-label">სურათი</label>
                                <input class="form-control" type="file" id="formFile" name="image" />
                            </div>
                            <div class="col">
                                <img src="{{ asset('images/graduates/' . $graduate -> image) }}"  class="w-25"/>
                            </div>
                        </div>
                    @else
                        <label for="formFile" class="form-label">სურათი</label>
                        <input class="form-control" type="file" id="formFile" name="image" />
                    @endif
                </div>
                <div class="mb-3">
                    @if($graduate -> poster)
                        <div class="row align-items-center">
                            <div class="col">
                                <label for="formFile" class="form-label">პოსტერი</label>
                                <input class="form-control" type="file" id="formFile" name="poster" />
                            </div>
                            <div class="col">
                                <img src="{{ asset('images/graduates/' . $graduate -> poster) }}" class="w-25"/>
                            </div>
                        </div>
                    @else
                        <label for="formFile" class="form-label">პოსტერი</label>
                        <input class="form-control" type="file" id="formFile" name="poster" />
                    @endif
                </div>
                <div class="mb-3">
                    <textarea  class="form-control" rows="5" name="description" placeholder="აღწერა" required>{{ $graduate -> description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

