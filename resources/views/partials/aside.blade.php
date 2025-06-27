<div class="tasks">
    <h2 class="section-title mb-4 fs-4 text-red">
        <i class="bi bi-binoculars fs-2"></i>
        <span class="section-title-label pb-2 decor-border">{{ __('static.section.tasks.title') }}</span>
    </h2>
    <ul class="list-group list-group-flush my-4">
        @foreach($categories as $category)
            <li class="list-group-item category-item">
                <a class="d-block category-link"
                    href="{{ route('categories.show', ['language' => app()->getLocale(), 'category' => $category->id]) }}">{{
            $category->title->$language }}</a>
            </li>
        @endforeach
    </ul>
    <div class="row">
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card ">
                <a class="d-block content-overlay text-decoration-none"
                    href="{{ route('visitors', ['language' => app()->getLocale()]) }}" target="_blank">
                    <div class="card-header task-card-header p-0">
                        <img src="{{ asset('images/tasks/visit-to-college.jpg') }}" class="card-img-top response-img"
                            alt="..." />
                    </div>
                    <div class="card-body task-card-body py-2">
                        <h5 class="card-title truncate p-1 text-red">
                            <i class="bi bi-person-walking"></i>
                            <span>{{ __('static.visit.title') }}</span>
                        </h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card">
                <a class="d-block text-decoration-none content-overlay" data-fancybox data-type="iframe"
                    href="https://www.youtube.com/watch?v=dtnR_kjOxOE">
                    <div class="card-header task-card-header p-0">
                        <img src="{{ asset('images/tasks/tour.jpg') }}" class="card-img-top response-img"
                            alt="Virtual Tour" />
                    </div>
                    <div class="card-body task-card-body py-2">
                        <h5 class="card-title truncate p-1 text-red">
                            <i class="bi bi-globe"></i>
                            <span>{{ __('static.pages.tour') }}</span>
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
            <div class="card task-card">
                <a class="d-block content-overlay text-decoration-none" data-fancybox
                    href="{{ asset('docs/static/student_guide.pdf') }}" target="_blank">
                    <div class="card-header task-card-header p-0">
                        <img src="{{ asset('images/tasks/admission.jpg') }}" class="card-img-top response-img"
                            alt="..." />
                    </div>
                    <div class="card-body task-card-body py-2">
                        {{-- <h5 class="card-title truncate text-red">{{ __('static.admission.title') }}</h5> --}}
                        <h5 class="card-title truncate p-1 text-red">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>{{ __('static.admission.title') }}</span>
                        </h5>
                    </div>
                </a>
            </div>
        </div>
        @foreach($tasks as $task)
            <div class="col-lg-12 col-md-4 col-sm-6 mb-4">
                <x-task-component :task="$task" :language="$language" />
            </div>
        @endforeach
    </div>
</div>