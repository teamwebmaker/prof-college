@extends('layouts.dashboard')
@section('title', 'Contacts List')
@section('main')
    @session('success')
    <div class="alert alert-success" role="alert"  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        {{ $value }}
    </div>
    @endsession
    <div class="row">
        @foreach($contacts as $contact)
            <div class="col-xl-4 col-lg-6 mb-4">
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
                    <div class="card-footer d-flex justify-content-between">
                        <a type="button" class="btn btn-success d-flex gap-2" href="{{ route('contacts.show', ['contact' => $contact, 'language' => app() -> getLocale()]) }}">
                            <i class="bi bi-eye"></i>
                            <span class="text-label">Show</span>
                        </a>
                        <form method="POST" action="{{ route('contacts.destroy', ['contact' => $contact, 'language' => app() -> getLocale()]) }}" onsubmit="return confirm('წავშალოთ კონტაქტი?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger d-flex gap-2">
                                <i class="bi bi-trash"></i>
                                <span class="text-label">Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection

