@extends('layouts.dashboard')
@section('title', 'სიახლის განახლება')
@section('main')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row mb-4">
        <h3>სიახლისთვის დოკუმენტის დამატება</h3>
        <div class="col-md-12">
            <form method="POST" action="{{ route('docs.store',['language' => app() -> getLocale()]) }}"  enctype="multipart/form-data">
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
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" required/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" name="src"  required/>
                </div>
                <input type="hidden" name="article_id" value="{{ $article -> id }}"/>
                <input type="hidden" name="uuid" value="{{ $article -> uuid }}"/>
                <button type="submit" class="btn btn-primary">დამატება</button>
            </form>
        </div>
    </div>
    <div class="row">
        <h3>სიახლის განახლება</h3>
        <div class="col-md-12">
            <form method="POST"  action="{{ route('articles.update', ['article' => $article, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title_ka" placeholder="სათაური" value="{{ $article -> title -> ka }}" required/>
                            @error('title_ka')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="description_ka" placeholder="აღწერა" required>{{ $article -> description -> ka }}</textarea>
                            @error('description_ka')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title_en" placeholder="Title" value="{{ $article -> title -> en }}" required/>
                            @error('title_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="description_en" placeholder="description" required>{{ $article -> description -> en }}</textarea>
                            @error('description_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <input type="file" class="form-control"  name="image"/>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('images/articles/' . $article -> image) }}"  class="w-50"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    @if($article -> embed)
                        <div class="row align-items-center">
                            <div class="col-8">
                                <input type="url" class="form-control" placeholder="ვიდეოს ლინკი(embed)" name="embed"  value="{{ $article -> embed }}"/>
                                @error('embed')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $article -> embed }}" title="YouTube video" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @else
                        <input type="url" class="form-control" placeholder="ვიდეოს ლინკი(embed)" name="embed"/>
                        @error('embed')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @endif
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category -> id }}"  @selected( $category -> id == $article -> category_id)>
                                {{ $category -> title -> ka }}
                            </option>
                        @endforeach
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

