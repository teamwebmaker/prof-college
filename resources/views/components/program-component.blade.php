@php
    $filePath = $doc->file->$language ?? null;
    $isDisabled = $filePath === null;
@endphp

<a class="doc-link text-decoration-none {{ $isDisabled ? 'disabled opacity-75 cursor-default' : '' }}"
    href="{{ $isDisabled ? '#' : asset(join('/', ['docs/documentations', $doc->category, $filePath])) }}"
    target="{{ $isDisabled ? '_self' : '_blank' }}"
    data-language="{{ $language }}">
    <div class="card px-3 py-2 doc-card"
        @if (!$isDisabled)
            data-bs-toggle="tooltip"
            data-bs-placement="bottom"
            title="{{ $doc->title->$language }}"
        @endif>
        <h6 class="module-title d-flex align-items-center gap-2">
            <i class="bi bi-filetype-pdf fs-3"></i>
            <span class="module-title-label truncate" data-language="{{ $language }}">
                {{ $doc->title->$language }}
            </span>
        </h6>
    </div>
</a>
