@if($language == "en" && $doc -> file -> en == null)
    <a class="doc-link text-decoration-none disabled opacity-75"  href="#">
        <div class="card px-3 py-2 doc-card">
            <h6 class="module-title d-flex align-items-center gap-2">
                <i class="bi bi-filetype-pdf fs-3"></i>
                <span class="module-title-label truncate">{{ $doc -> title -> $language  }}</span>
            </h6>
        </div>
    </a>
@else
    <a class="doc-link text-decoration-none" href="{{ asset(join('/', ['docs/documentations',  $doc -> file -> $language])) }}" target="_blank">
        <div class="card px-3 py-2 doc-card">
            <h6 class="module-title d-flex align-items-center gap-2">
                <i class="bi bi-filetype-pdf fs-3"></i>
                <span class="module-title-label truncate">{{ $doc -> title -> $language  }}</span>
            </h6>
        </div>
    </a>
@endif

