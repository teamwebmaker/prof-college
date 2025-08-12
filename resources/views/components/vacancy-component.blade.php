<div class="card vacancy-card h-100 border-0 shadow-sm hover-shadow transition-all">
    <div class="card-body p-4 d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h3 class="h5 fw-bold mb-0 text-dark" data-language="{{ $language }}">{{ $vacancy->title }}</h3>
            <span class="badge bg-red bg-opacity-10 text-red rounded-pill px-3 py-2">
                <i class="bi bi-arrow-up-right me-1"></i>
                <span data-language="{{ $language }}">Open</span>
            </span>
        </div>

        <div class="mt-auto">
            <a href="{{ asset('vacancies/'.$vacancy->file) }}"
                data-fancybox
                data-type="iframe"
                data-preload="false"
                class="btn btn-link text-red text-decoration-none p-0 d-inline-flex align-items-center"
                data-language="{{ $language }}">
                {{ __('static.details') }}
                <i class="bi bi-chevron-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
