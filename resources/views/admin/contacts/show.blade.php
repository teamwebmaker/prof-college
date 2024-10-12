@extends('layouts.dashboard')
@section('title', 'Contact')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $contact -> full_name }}</li>
                            <li class="list-group-item">
                                <a class="d-block  text-decoration-none" href="mailto:{{ $contact -> email }}">
                                    {{ $contact -> email }}
                                </a>
                            </li>
                            <li class="list-group-item">{{ $contact -> subject }}</li>
                            @if($contact -> phone)
                                <li class="list-group-item">{{ $contact -> phone }}</li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        {{ $contact -> message }}
                    </div>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

