<div class="card mb-3 article-card">
    <div class="row g-0">
        <div class="col-xl-5">
            @if($article -> embed)
                <a href="{{ $article -> embed }}" data-fancybox data-caption="Single image">
                    <div class="card-head article-card-head article-video-player" data-content="{{ explode(' ', $article -> created_at)[0] }}">
                        <img src="{{ asset('images/articles/' . $article -> image) }}" class="response-img rounded-start article-image" alt="...">
                    </div>
                </a>
            @else
                <div class="card-head article-card-head" data-content="{{ explode(' ', $article -> created_at)[0] }}">
                    <img src="{{ asset('images/articles/' . $article -> image) }}" class="rounded-start article-image" alt="...">
                </div>
            @endif
        </div>
        <div class="col-xl-7 d-flex justify-content-between flex-column">
            <div class="card-body">
                <h5 class="card-title truncate cursor-default" title="{{ $article -> title -> $language }}">{{ $article -> title -> $language }}</h5>
                <p class="card-text line-clamp">{{ $article -> description -> $language }}</p>
            </div>
            <div class="card-footer bg-transparent px-2 overflow-hidden">
                <a type="button" class="btn view-more-btn float-end rounded-1" href="{{  route('articles.show', ['article' => $article, 'language' => app() -> getLocale()]) }}">{{ __('static.pages.more') }}</a>
            </div>
        </div>
    </div>
</div>


{{--<div class="card-head article-card-head" data-content="{{ $article -> created_at }}">--}}
{{--    <img src="{{ asset('images/articles/' . $article -> image) }}" class="rounded-start article-image" alt="..."/>--}}
{{--</div>--}}
