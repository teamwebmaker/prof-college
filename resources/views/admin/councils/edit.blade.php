@extends('layouts.dashboard')
@section('title', 'საბჭოს წევრის შექმნა')
@section('main')
    <div class="row">
        @session('success')
        <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ $value }}
        </div>
        @endsession
        <div class="col-md-12">
            <form method="POST"  action="{{ route('councils.update', ['council' => $council, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="first_name_ka" placeholder="სახელი" value="{{ $council -> first_name -> ka }}" required/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="last_name_ka" placeholder="გვარი" value="{{ $council -> last_name -> ka }}" required/>
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="representative_ka" placeholder="წარმომადგენელი"  required>{{ $council -> representative -> ka }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="first_name_en" placeholder="First Name" value="{{ $council -> first_name -> en}}" required/>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="last_name_en" placeholder="Last Name" value="{{ $council -> last_name -> en }}" required/>
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="representative_en" placeholder="Representative" required>{{ $council -> representative -> en }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

