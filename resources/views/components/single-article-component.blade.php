<div class="single-article doc-row">
    <div class="card  single-article-card">
        <div class="row g-0">
            <div class="col-xl-4 multimedia-block" style="--background-image: url({{ asset('images/articles/' . $article -> image) }})">
                {{-- If the article has an embed video, use it as a background --}}
                @if($article -> embed)
                    <a href="{{ $article -> embed }}" data-fancybox data-caption="Single image">
                        <div class="card-head article-card-head article-video-player" data-content="{{ $article -> created_at -> format('Y-m-d') }}">
                            <img src="{{ asset('images/articles/' . $article -> image) }}" class="img-fluid rounded-start article-image" alt="...">
                        </div>
                    </a>
                @else
                    <div class="card-head article-card-head" data-content="{{ $article -> created_at }}">
                        <img src="{{ asset('images/articles/' . $article -> image) }}" class="img-fluid rounded-start article-image" alt="...">
                    </div>
                @endif
            </div>
            <div class="col-xl-8">
                <div class="card-body">
                    <h5 class="card-title article-title">{{ $article -> title -> $language }}</h5>
                    <p class="card-text article-text">{{ $article -> description -> $language }}</p>
                </div>
            </div>
        </div>
    </div>
    @if($article -> docs -> isNotEmpty())
        <div class="card docs-card">
            <div class="row px-2">
                @foreach($article -> docs as $doc)
                    <div class="col-xl-4 col-lg-6 mb-4">
                        <a class="doc-link text-decoration-none d-block" href="{{ asset('docs/articles/' .$article -> uuid .'/' .$doc -> src) }}" target="_blank">
                            <div class="row flex-nowrap align-items-center">
                                <div class="col-sm-1">
                                    <img src="{{ asset('images/formats/' . $doc -> type . '.png') }}" class="format-icon"/>
                                </div>
                                <div class="col-sm-10">
                                    <h6 class="single-article-title">
                                        <span class="module-title-label truncate text-red">{{ $doc -> title -> $language  }}</span>
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
<div class="row pt-4 ">
    <div class="col">
        <button class="btn bg-dark-red text-white float-end share-btn" data-sharer="facebook"  data-url="{{ url() -> current() }}" data-title="{{ $article -> title -> $language }}" data-image="{{ asset('images/articles/' . $article -> image ) }}">
            <i class="bi bi-facebook"></i>
            share
        </button>
    </div>
</div>
