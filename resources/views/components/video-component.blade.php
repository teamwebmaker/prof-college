<div class="card video-card">
    <div class="card-header video-card-header ">
        <h6 class="card-title truncate">{{$video -> title -> $language}}</h6>
    </div>
    <div class="card-body p-0">
        <div class="ratio ratio-4x3">
            <iframe src="{{ $video -> url }}" title="YouTube video" allowfullscreen></iframe>
        </div>
    </div>
</div>
