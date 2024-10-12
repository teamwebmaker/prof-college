@extends('layouts.dashboard')
@section('title', 'პროფესიის შექმნა')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('professions.store', ['language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="type_ka" placeholder="ტიპი"  />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="condition_ka" placeholder="წინაპირობა"  />
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="type_en" placeholder="Type"  />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="condition_en" placeholder="Condition"  />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control"  name="image" />
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="დონე" name="level"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="კრედიტების რაოდენობა ქართულენოვანი სტუდენტებისთვის" name="credits"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="კრედიტების რაოდენობა არაქართულენოვანი სტუდენტებისთვის" name="custom_credits"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="პროგრამის  ხანგრძლივობა ქართულენოვანი სტუდენტებისთვის" name="duration"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="პროგრამის  ხანგრძლივობა არაქართულენოვანი სტუდენტებისთვის" name="custom_duration"/>
                </div>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

