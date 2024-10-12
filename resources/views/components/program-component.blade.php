<a class="doc-link text-decoration-none" href="{{ asset(join('/', ['docs/programs', $program -> category, $program -> file -> $language])) }}" target="_blank">
    <div class="card px-3 py-2 doc-card">
        <h6 class="module-title d-flex align-items-center gap-2">
            <i class="bi bi-filetype-pdf fs-3"></i>
            <span class="module-title-label truncate">{{ $program -> title -> $language  }}</span>
        </h6>
    </div>
</a>
