@extends('layouts.dashboard')
@section('title', 'საბჭოს წევრის შექმნა')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('programs.update', ['program' => $program, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" required value="{{ $program -> title -> ka }}"/>
                        </div>
                        <div class="mb-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="file" class="form-control" name="file_ka" placeholder="დოკუმენტი"/>
                                </div>
                                <div class="col">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ asset('docs/programs/'.$program -> category .'/'.$program -> file -> ka) }}" title="YouTube video" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" required value="{{ $program -> title -> en }}"/>
                        </div>
                        <div class="mb-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="file" class="form-control" name="file_en" placeholder="File"/>
                                </div>
                                <div class="col">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ asset('docs/programs/'.$program -> category .'/'.$program -> file -> en) }}" title="YouTube video" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="category" required>
                        <option selected disabled>პროგრამის კატეგორია</option>
                        <option value="modular" @if($program -> category == "modular") selected @endif>მოდულარუილი</option>
                        <option value="dual" @if($program -> category == "dual") selected @endif>დუალური</option>
                        <option value="integrated" @if($program -> category == "integrated") selected @endif>ინტეგრირებული</option>
                        <option value="short_term" @if($program -> category == "short_term") selected @endif>მოკლევადიანი</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

