@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('styles/components/employer.css') }}" />
    @endpush
@endonce

@php
    // Get the appropriate language version from the casted title
    $displayTitle = $employer->title -> $language;
@endphp

<div class="card employer-card shadow-sm border-0 position-relative overflow-hidden">
    <div class="row g-0 align-items-center">
        <!-- Image section -->
        <div class="col-sm-4">
            @if($employer->url)
                <a href="{{ $employer->url }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/employers/' . $employer->image) }}"
                        class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $displayTitle }}">
                </a>
            @else
                <img src="{{ asset('images/employers/' . $employer->image) }}"
                    class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $displayTitle }}">
            @endif
        </div>
        <!-- Content section -->
        <div class="col-sm-8">
            <div class="card-body ps-0">
                @if($employer->url)
                    <a href="{{ $employer->url }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                        <p class="card-title fs-6 fw-semibold mb-0 line-clamp"
                            title="{{ $displayTitle }}"
                            data-language="{{ $language }}">
                            {{ $displayTitle }}
                        </p>
                    </a>
                @else
                    <p class="card-title fs-6 fw-semibold mb-0 line-clamp"
                        title="{{ $displayTitle }}"
                        data-language="{{ $language }}">
                        {{ $displayTitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>