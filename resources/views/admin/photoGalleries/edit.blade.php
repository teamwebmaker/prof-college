@extends('layouts.dashboard')
@section('title', 'საბჭოს წევრის შექმნა')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('galleries.update',['gallery' => $gallery, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="ka-tab" data-bs-toggle="tab" data-bs-target="#ka-tab-content" type="button" role="tab" aria-controls="ka-tab-content" aria-selected="true">KA</button>
                        <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-tab-content" type="button" role="tab" aria-controls="en-tab-content" aria-selected="false">EN</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="ka-tab-content" role="tabpanel" aria-labelledby="ka-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" required value="{{ $gallery -> title -> ka }}"/>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" required value="{{ $gallery -> title -> en }}"/>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
    <div class="row my-5">
        @foreach($gallery -> gallery_images as $image)
            <div class="col-md-3 mb-4 position-relative">
                <img src="{{ asset('images/galleries/' .$gallery -> uuid .'/' .$image -> image) }}" class="d-block w-100 position-relative"/>
                <form method="POST" action="{{ route('images.destroy', ['image' => $image, 'language'=> app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ სურათი?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger d-flex gap-2 overlay-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
    <div class="row">
        <h2 class="mb-4">სურათის დამატება გალერიაში</h2>
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data" action="{{ route('images.store', ['language' => app() -> getLocale()]) }}">
                @csrf
                <div class="mb-3">
                    <input type="file" class="form-control" name="image"  required />
                </div>
                <input type="hidden" class="form-control" name="gallery_id"  value="{{ $gallery -> id }}" />
                <input type="hidden" class="form-control" name="uuid"  value="{{ $gallery -> uuid }}" />
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

