<div class="card employer-card shadow-sm border-0">
    <div class="row g-0 align-items-center">
        <!-- Image section -->
        <div class="col-sm-4">
            <img src="{{ asset('images/employers/' . $employer->image) }}"
                class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="{{ $employer->title }}">
        </div>

        <!-- Content section -->
        <div class="col-sm-8">
            <div class="card-body ps-0">
                <p class="card-title fs-6 fw-semibold text-danger mb-0 line-clamp"
                    title="{{ $employer->title }}"
                    data-language="{{ $language }}">
                    {{ $employer->title }}
                </p>
            </div>
        </div>
    </div>
</div>
