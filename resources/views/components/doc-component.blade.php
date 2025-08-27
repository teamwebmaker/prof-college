@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('styles/components/doc.css') }}" />
    @endpush
@endonce
@php
    $filePath = $doc->file->$language ?? null;
    $isDisabled = $filePath === null;

    // Build the URL with query string if file exists (date only, no time)
    $fileUrl = $isDisabled ? '#' : asset('docs/documentations/' . $doc->category . '/' . $filePath) . '?updated=' . \Carbon\Carbon::parse($doc->updated_at)->format('Y-m-d');
@endphp
@php
    $sectionTranslations = [
        'normative' => 'ნორმატიული აქტები',
        'internal-acts' => 'შიდა აქტები',
        'library-report' => 'ბიბლიოთეკის ანგარიში',
        'inclusive-report' => 'ინკლ. განათლების ანგარიში',
    ];
@endphp
<a class="doc-link text-decoration-none {{ $isDisabled ? 'disabled opacity-75 cursor-default' : '' }}"
    href="{{ $fileUrl }}"
    target="{{ $isDisabled ? '_self' : '_blank' }}">
    <div class="card px-3 py-2 doc-card position-relative"
        @if (!$isDisabled)
            data-bs-toggle="tooltip"
            data-bs-placement="bottom"
            title="{{ $doc->title->$language }}"
        @endif>
        @if(!empty($doc->section))
        <span class="position-absolute top-0 end-0 small px-2 py-1 rounded-start bg-dark-red text-white"
            style="border-top-left-radius: 0px !important;"
            data-language="{{ $language }}">
            {{ $sectionTranslations[$doc->section] ?? $doc->section }}
        </span>
        @endif
        <h6 class="module-title d-flex align-items-center gap-1 mt-3">
            <i class="bi bi-journal-check fs-4"></i>
            <span class="truncate p-1" data-language="{{ $language }}">
                {{ $doc->title->$language }}
            </span>
        </h6>
    </div>
</a>
