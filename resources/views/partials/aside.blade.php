<div class="tasks">
    <h2 class="section-title mb-4 fs-4 text-red">
        <i class="bi bi-binoculars"></i>
        <span class="section-title-label pb-2 decor-border">{{ __('static.section.tasks.title') }}</span>
    </h2>
    <ul class="list-group list-group-flush my-4">
        @foreach($categories as $category)
            <li class="list-group-item category-item">
                <a class="d-block category-link" href="{{ route('categories.show', ['language' => app() -> getLocale(), 'category' => $category -> id]) }}">{{ $category -> title -> $language }}</a>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card">
                <div class="card-header task-card-header p-0">
                    <a class="d-block content-overlay" href="{{ route('visitors', ['language' => app() -> getLocale()]) }}" target="_blank">
                        <img src="{{ asset('images/tasks/visit-to-college.jpg') }}" class="card-img-top response-img" alt="..." />
                    </a>
                </div>
                <div class="card-body task-card-body py-2">
                    <h5 class="card-title truncate text-red">{{ __('static.visit.title') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card">
                <div class="card-header task-card-header p-0">
                    <a class="d-block content-overlay" href="https://www.youtube.com/watch?v=dtnR_kjOxOE" target="_blank">
                        <img src="{{ asset('images/tasks/tour.jpg') }}" class="card-img-top response-img" alt="..." />
                    </a>
                </div>
                <div class="card-body task-card-body py-2">
                    <h5 class="card-title truncate text-red">{{ __('static.pages.tour') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card">
                <div class="card-header task-card-header p-0">
                    <a class="d-block content-overlay" href="{{ asset('docs/static/student_guide.pdf') }}" target="_blank">
                        <img src="{{ asset('images/tasks/admission.jpg') }}" class="card-img-top response-img" alt="..." />
                    </a>
                </div>
                <div class="card-body task-card-body py-2">
                    <h5 class="card-title truncate text-red">{{ __('static.admission.title') }}</h5>
                </div>
            </div>
        </div>
        @foreach($tasks as $task)
            <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
                <x-task-component :task="$task" :language="$language"/>
            </div>
        @endforeach
    </div>
</div>
