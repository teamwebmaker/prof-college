@php
    $filePath = $doc->file->$language ?? null;
    $isDisabled = $language === 'en' && $filePath === null;
@endphp

<a class="doc-link text-decoration-none {{ $isDisabled ? 'disabled opacity-75' : '' }}"
    href="{{ $isDisabled ? '#' : asset('docs/documentations/' . $filePath) }}"
    target="{{ $isDisabled ? '_self' : '_blank' }}">
    <div class="card px-3 py-2 doc-card" @if (!$isDisabled) data-bs-toggle="tooltip" data-bs-placement="bottom"
    title="{{ $doc->title->$language }}" @endif>
        <h6 class="module-title d-flex align-items-center gap-1">
            <i class="bi bi-journal-check fs-4"></i>
            <span class="truncate p-1">
                {{ $doc->title->$language }}
            </span>
        </h6>
    </div>
</a>