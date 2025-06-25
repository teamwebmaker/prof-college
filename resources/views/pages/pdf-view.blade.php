@extends('layouts.master')
@section('title', __('static.pages.pdf_view') . '/' . $fileName)

@section('main')
  <div class="vh-100 d-flex flex-column bg-light">
    <!-- PDF Viewer -->
    <div class="flex-grow-1">
    <iframe src="{{ asset('docs/static/' . $fileName) }}" class="w-100 h-100 border-0" allowfullscreen></iframe>
    </div>
  </div>
@endsection