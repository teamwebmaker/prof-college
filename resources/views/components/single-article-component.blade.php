@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('styles/components/single-article.css') }}" />
    @endpush
@endonce

<div class="classic-article-container">
    <div class="classic-article-card">
        <div class="classic-article-header">
            @if($article->embed)
                <a href="{{ $article->embed }}" class="classic-media-link" data-fancybox data-caption="{{ $article->title->$language }}">
                    <img src="{{ asset('images/articles/' . $article->image) }}"
                        class="classic-article-image"
                        alt="{{ $article->title->$language }}">
                    <div class="play-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </a>
            @else
                <img src="{{ asset('images/articles/' . $article->image) }}"
                    class="classic-article-image"
                    alt="{{ $article->title->$language }}">
            @endif
        </div>

        <div class="classic-article-body">
            <div class="article-meta">
                <span class="article-date">{{ $article->created_at->format('F j, Y') }}</span>
            </div>
            <h2 class="article-title" data-language="{{ $language }}">{{ $article->title->$language }}</h2>
            <p class="article-text" data-language="{{ $language }}">{{ $article->description->$language }}</p>

            @if($article->docs->isNotEmpty())
            <div class="attachments-section">
                <h4 class="attachments-title">Documents</h4>
                <div class="attachments-list">
                    @foreach($article->docs as $doc)
                    <a href="{{ asset('docs/articles/' .$article->uuid .'/' .$doc->src) }}"
                        class="attachment-item"
                        target="_blank">
                        <div class="attachment-icon">
                            <img src="{{ asset('images/formats/' . $doc->type . '.png') }}"
                                alt="{{ $doc->type }} icon">
                        </div>
                        <div class="attachment-details">
                            <span class="attachment-name" data-language="{{ $language }}">{{ $doc->title->$language }}</span>
                            <span class="attachment-type">{{ strtoupper($doc->type) }}</span>
                        </div>
                        <div class="attachment-action">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="article-footer">
                <button class="share-button"
                        data-sharer="facebook"
                        data-url="{{ url()->current() }}"
                        data-title="{{ $article->title->$language }}"
                        data-image="{{ asset('images/articles/' . $article->image ) }}">
                        <i class="bi bi-facebook"></i> {{ __('static.share') }}
                </button>
            </div>
        </div>
    </div>
</div>
