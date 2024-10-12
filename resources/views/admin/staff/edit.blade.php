@extends('layouts.dashboard')
@section('title', 'ადმინისტრაციის წევრის განახლება')
@section('main')
    @session('error')
    <div class="alert alert-danger" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        <div class="col-md-12">
            <form method="POST"  action="{{ route('staff.update', ['staff' => $staff, 'language' => app() -> getLocale()]) }}" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="full_name_ka" placeholder="სახელი და გვარი" required value="{{ $staff -> full_name -> ka }}"/>
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="position_ka" placeholder="პოზიცია" required>{{ $staff -> position -> en }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane pt-2 fade" id="en-tab-content" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="full_name_en" placeholder="Full Name" required value="{{ $staff -> full_name -> en }}"/>
                        </div>
                        <div class="mb-3">
                            <textarea  class="form-control" rows="5" name="position_en" placeholder="Position" required>{{ $staff -> position -> ka }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <input type="file" class="form-control"  name="image"/>
                        </div>
                        <div class="col">
                            <img class="w-25"  src="{{ asset('images/staff/' . $staff  -> image) }}"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="ემაილი" name="email" @if($staff -> email) value="{{ $staff  -> email }}" @endif/>
                </div>
                <button type="submit" class="btn btn-primary">განახლება</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

