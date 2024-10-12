@php
    use Illuminate\Support\Str;
@endphp
<meta property="og:title" content='{{ $article -> title -> $language }}' />
<meta property="og:description" content='{{ Str::substr( $article -> description -> $language, 0, 150)}}' />
<meta property="og:image" content='{{ asset("images/articles/" . $article -> image ) }}' />
<meta property="og:url" content='{{ url() -> current() }}' />
<meta property="og:locate" content='{{ app() -> getLocale() }}' />
<meta property="og:type" content='website' />
<meta property="og:site_name" content='Profgldani.ge' />
