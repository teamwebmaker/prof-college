@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('styles/components/teacher.css') }}" />
    @endpush
@endonce

<div class="teacher-card-split">
    <div class="row g-0">
        <!-- Image Column (6) -->
        <div class="col-md-5 teacher-image-col">
            <div class="teacher-image-container">
                <img src="{{ asset('images/teachers/' . $teacher->image) }}"
                    class="teacher-image"
                    alt="{{ $teacher->full_name->$language }}"
                    loading="lazy">
                <div class="teacher-image-overlay"></div>
            </div>
        </div>

        <!-- Content Column (6) -->
        <div class="col-md-7 teacher-content-col">
            <div class="teacher-content">
                <div class="teacher-info-row">
                    <span class="teacher-label" data-language="{{ $language }}">
                        {{ __('static.pages.teachers.teacher')}}:
                    </span>
                    <span class="teacher-value" data-language="{{ $language }}">
                        {{ $teacher->full_name->$language }}
                    </span>
                </div>
                <div class="teacher-info-row">
                    <span class="teacher-label" data-language="{{ $language }}">
                        {{ __('static.pages.teachers.subject')}}:
                    </span>
                    <span class="teacher-value" data-language="{{ $language }}">
                        {{ $teacher->subject->$language }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
