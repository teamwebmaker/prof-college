@extends('layouts.dashboard')
@section('title', 'პროფესიის განახლება')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('professions.update', ['profession' => $profession, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" value="{{ $profession -> title -> ka }}" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="type_ka" placeholder="ტიპი" value="{{ $profession -> type -> ka }}"  />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="condition_ka" placeholder="წინაპირობა"  value="{{ $profession -> condition -> ka }}" />
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" value="{{ $profession -> title -> en }}" />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="type_en" placeholder="Type" value="{{ $profession -> type -> en }}"  />
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="condition_en" placeholder="Condition" value="{{ $profession -> condition -> en }}"  />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    @if($profession -> image)
                        <div class="row">
                            <div class="col">
                                <input type="file" class="form-control"  name="image" />
                            </div>
                            <div class="col">
                                <img class="w-25" src="{{ asset('images/professions/' . $profession -> image) }}"/>
                            </div>
                        </div>
                    @else
                        <input type="file" class="form-control"  name="image" />
                    @endif
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="დონე" name="level" value="{{ $profession -> level }}"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="კრედიტების რაოდენობა ქართულენოვანი სტუდენტებისთვის" name="credits" value="{{ $profession -> credits }}"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="კრედიტების რაოდენობა არაქართულენოვანი სტუდენტებისთვის" name="custom_credits"  value="{{ $profession -> custom_credits }}"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="პროგრამის  ხანგრძლივობა ქართულენოვანი სტუდენტებისთვის" name="duration"  value="{{ $profession -> duration }}"/>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="პროგრამის  ხანგრძლივობა არაქართულენოვანი სტუდენტებისთვის" name="custom_duration" value="{{ $profession -> custom_duration }}" />
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

