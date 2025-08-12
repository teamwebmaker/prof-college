<div class="card video-card">
    <div class="card-header video-card-header">
        <h6 class="card-title truncate"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            title="{{$video->title->$language}}"
            style="cursor:default;"
            data-language="{{ $language }}">
            {{$video->title->$language}}
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="ratio ratio-4x3">
            <iframe src="{{ $video->url }}"
                title="YouTube video"
                allowfullscreen
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title="Click to watch {{$video->title->$language}}"
                data-language="{{ $language }}">
            </iframe>
        </div>
    </div>
</div>
