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
            <form method="POST"  action="{{ route('programs.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
                @csrf
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="ka-tab" data-bs-toggle="tab" data-bs-target="#ka-tab-content" type="button" role="tab" aria-controls="ka-tab-content" aria-selected="true">KA</button>
                        <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-tab-content" type="button" role="tab" aria-controls="en-tab-content" aria-selected="false">EN</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="ka-tab-content" role="tabpanel" aria-labelledby="ka-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" required/>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="file_ka" placeholder="დოკუმენტი" required/>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" required/>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="file_en" placeholder="File" required/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="category" required>
                        <option selected disabled>პროგრამის კატეგორია</option>
                        <option value="modular">მოდულარუილი</option>
                        <option value="dual">დუალური</option>
                        <option value="integrated">ინტეგრირებული</option>
                        <option value="short_term">მოკლევადიანი</option>
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

