<div class="card mb-3 teacher-card">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('images/teachers/' . $teacher->image) }}" class="img-fluid rounded-start article-image" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <p class="card-title fs-6 text-red">
                    <span class="fw-bolder" data-language="{{ $language }}">
                        {{ __('static.pages.teachers.teacher')}}:
                    </span>
                    <span data-language="{{ $language }}">{{ $teacher->full_name->$language }}</span>
                </p>
                <p class="card-text text-red">
                    <span class="fw-bolder" data-language="{{ $language }}">
                        {{ __('static.pages.teachers.subject')}}:
                    </span>
                    <span data-language="{{ $language }}">{{ $teacher->subject->$language }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
