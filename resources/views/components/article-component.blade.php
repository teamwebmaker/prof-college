<div class="modern-article-card">
    <div class="modern-article-media">
        @if($article->embed)
            <a href="{{ $article->embed }}" class="modern-article-link" data-fancybox data-caption="Single image">
                <div class="modern-article-image-container" data-date="{{ explode(' ', $article->created_at)[0] }}">
                    <img src="{{ asset('images/articles/' . $article->image) }}" class="modern-article-image" alt="{{ $article->title->$language }}">
                    <div class="modern-article-play-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 16.5V7.5L16 12L10 16.5Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </a>
        @else
            <div class="modern-article-image-container" data-date="{{ explode(' ', $article->created_at)[0] }}">
                <img src="{{ asset('images/articles/' . $article->image) }}" class="modern-article-image" alt="{{ $article->title->$language }}" />
            </div>
        @endif
    </div>

    <div class="modern-article-content">
        <div class="modern-article-text">
            <h3 class="modern-article-title" title="{{ $article->title->$language }}" data-language="{{ $language }}">
                {{ $article->title->$language }}
            </h3>
            <p class="modern-article-excerpt" data-language="{{ $language }}">
                {{ $article->description->$language }}
            </p>
        </div>

        <div class="modern-article-footer">
            <a href="{{ route('articles.show', ['article' => $article, 'language' => app()->getLocale()]) }}"
                class="modern-article-button"
                data-language="{{ $language }}">
                {{ __('static.pages.more') }}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</div>
