@extends('layouts.dashboard')
@section('title', 'დოკუმენტის შექმნა')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('documents.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="file" class="form-control" name="file_ka"  required/>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title"/>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="file_en"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="category">
                        <option disabled selected>კატეგორიები</option>
                        <option value="acts">სამართლებრივი აქტები</option>
                        <option value="activates">ანგარიშები / აქტიობები</option>
                        <option value="structure">მისია / ხედვა / ღირებულება</option>
                        <option value="educations">სასწავლო პროცესი</option>
                        <option value="legislative">საკანონმდებლო აქტები</option>
                        <option value="subordinate">კანონქვემდებარე აქტები</option>
                    </select>
                </div>
                <button type="submit" class=" btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

