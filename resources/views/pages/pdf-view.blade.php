@extends('layouts.master')

@section('title', __('static.pages.pdf_view') . '/' . $fileName)

@section('main')
  <div class="pdf-viewer-container vh-100 d-flex flex-column bg-transparent">
    <iframe 
      src="{{ asset('docs/static/' . $fileName) }}#view=FitH&toolbar=0&pagemode=none" 
      class="w-100 h-100 border-0 flex-grow-1 bg-transparent"
      allowfullscreen
    ></iframe>
  </div>
@endsection