@once
    @push('styles')
    <link rel="stylesheet" href="{{ asset('styles/components/staff.css') }}" />
    @endpush
@endonce

<div class="staff-card">
    <div class="staff-card__image-container">
        <img
            src="{{ asset('images/staff/' . $staff->image) }}"
            alt="{{ $staff->full_name->$language }}"
            class="staff-card__image"
            loading="lazy"
        >
        <div class="staff-card__overlay"></div>
    </div>

    <div class="staff-card__content">
        <h3 class="staff-card__name" data-language="{{ $language }}">
            {{ $staff->full_name->$language }}
        </h3>
        <p class="staff-card__position" data-language="{{ $language }}">
            {{ $staff->position->$language }}
        </p>

        <div class="staff-card__social">
            <!-- Optional social links could go here -->
        </div>
    </div>
</div>
