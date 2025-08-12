@extends('layouts.master')
@section('meta')
    @include('partials.share-meta')
@endsection
@section('title', __('static.pages.title'))

@section('styles')
    <style>
.classic-article-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Georgia', 'Times New Roman', serif;
}

.classic-article-card {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
}

.classic-article-header {
    position: relative;
    border-bottom: 1px solid #e0e0e0;
}

.classic-article-image {
    width: 100%;
    height: auto;
    display: block;
}

.play-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.7);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.classic-article-body {
    padding: 25px;
}

.article-meta {
    margin-bottom: 15px;
}

.article-date {
    color: #666;
    font-size: 14px;
    font-style: italic;
}

.article-title {
    font-size: 24px;
    margin: 0 0 15px 0;
    color: #333;
    font-weight: bold;
    line-height: 1.3;
}

.article-text {
    font-size: 16px;
    line-height: 1.6;
    color: #444;
    margin-bottom: 25px;
}

.attachments-section {
    margin: 25px 0;
    padding-top: 15px;
    border-top: 1px dashed #ddd;
}

.attachments-title {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
    font-weight: bold;
}

.attachments-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.attachment-item {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    background: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 3px;
    text-decoration: none;
    color: #333;
    transition: all 0.2s ease;
}

.attachment-item:hover {
    background: #f0f0f0;
    border-color: #ccc;
}

.attachment-icon {
    margin-right: 15px;
}

.attachment-icon img {
    width: 32px;
    height: 32px;
}

.attachment-details {
    flex: 1;
    min-width: 0;
}

.attachment-name {
    display: block;
    font-size: 15px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.attachment-type {
    font-size: 12px;
    color: #666;
}

.attachment-action {
    margin-left: 15px;
    color: #666;
    font-size: 14px;
}

.article-footer {
    display: flex;
    justify-content: flex-end;
    padding-top: 15px;
    border-top: 1px dashed #ddd;
}

.share-button {
    background: var(--dark-red);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 3px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s ease;
}

.share-button:hover {
    background: var(--light-red);
}

.share-button i {
    margin-right: 5px;
}
    </style>
@endsection
@section('main')
    <div class="container">
        <div class="row">
            <div class="col mb-4">
                <x-single-article-component :article="$article" :language="$language"/>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
    <script>
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider );
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
@endsection
