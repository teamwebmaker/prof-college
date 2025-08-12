<div class="modern-tasks-container">
    <!-- Section Header -->

    <h2 class="section-title mb-4 fs-4 text-red">
        <i class="bi bi-pin-angle fs-2"></i>
        <span class="section-title-label pb-2 decor-border" data-language="ka">საინფორმაციო დაფა</span>
    </h2>

    <!-- Categories List -->
    <div class="modern-categories-list">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', ['language' => app()->getLocale(), 'category' => $category->id]) }}"
                class="modern-category-item"
                data-language="{{ $language }}">
                {{ $category->title->$language }}
                <svg class="modern-category-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.59 16.59L13.17 12L8.59 7.41L10 6L16 12L10 18L8.59 16.59Z" fill="currentColor"/>
                </svg>
            </a>
        @endforeach
    </div>

    <!-- Tasks Grid -->
    <div class="modern-tasks-grid">
        <!-- Visit Card -->
        <div class="modern-task-card-wrapper">
            <a href="{{ route('visitors', ['language' => app()->getLocale()]) }}" class="modern-task-card" target="_blank">
                <div class="modern-task-image-container">
                    <img src="{{ asset('images/tasks/visit-to-college.jpg') }}" class="modern-task-image" alt="{{ __('static.visit.title') }}" />
                    <div class="modern-task-overlay">
                        <svg class="modern-task-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12.5 7H11V13L16.2 16.2L17 14.9L12.5 12.2V7Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div class="modern-task-content">
                    <svg class="modern-task-content-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5.5C13.38 5.5 14.5 6.62 14.5 8C14.5 9.38 13.38 10.5 12 10.5C10.62 10.5 9.5 9.38 9.5 8C9.5 6.62 10.62 5.5 12 5.5ZM12 12.5C13.38 12.5 14.5 13.62 14.5 15C14.5 16.38 13.38 17.5 12 17.5C10.62 17.5 9.5 16.38 9.5 15C9.5 13.62 10.62 12.5 12 12.5ZM12 19.5C13.38 19.5 14.5 20.62 14.5 22C14.5 23.38 13.38 24.5 12 24.5C10.62 24.5 9.5 23.38 9.5 22C9.5 20.62 10.62 19.5 12 19.5Z" fill="currentColor"/>
                    </svg>
                    <h3 class="modern-task-title" data-language="{{ $language }}">
                        {{ __('static.visit.title') }}
                    </h3>
                </div>
            </a>
        </div>

        <!-- Virtual Tour Card -->
        <div class="modern-task-card-wrapper">
            <a href="https://www.youtube.com/watch?v=dtnR_kjOxOE" class="modern-task-card" data-fancybox data-type="iframe">
                <div class="modern-task-image-container">
                    <img src="{{ asset('images/tasks/tour.jpg') }}" class="modern-task-image" alt="Virtual Tour" />
                    <div class="modern-task-overlay">
                        <svg class="modern-task-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.5L16 12L10 7.5V16.5ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div class="modern-task-content">
                    <svg class="modern-task-content-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 3H3C1.9 3 1 3.9 1 5V19C1 20.1 1.9 21 3 21H21C22.1 21 23 20.1 23 19V5C23 3.9 22.1 3 21 3ZM21 19H3V5H21V19ZM8 15L13 12L8 9V15Z" fill="currentColor"/>
                    </svg>
                    <h3 class="modern-task-title" data-language="{{ $language }}">
                        {{ __('static.pages.tour') }}
                    </h3>
                </div>
            </a>
        </div>

        <!-- Admission Guide Card -->
        <div class="modern-task-card-wrapper">
            <a href="{{ asset('docs/static/student_guide.pdf') }}" class="modern-task-card" data-fancybox data-type="iframe" data-preload="false" target="_blank">
                <div class="modern-task-image-container">
                    <img src="{{ asset('images/tasks/admission.jpg') }}" class="modern-task-image" alt="Admission Guide" />
                    <div class="modern-task-overlay">
                        <svg class="modern-task-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM18 20H6V4H13V9H18V20ZM8 10H16V12H8V10ZM8 14H16V16H8V14Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div class="modern-task-content">
                    <svg class="modern-task-content-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM18 20H6V4H13V9H18V20ZM8 10H16V12H8V10ZM8 14H16V16H8V14Z" fill="currentColor"/>
                    </svg>
                    <h3 class="modern-task-title" data-language="{{ $language }}">
                        {{ __('static.admission.title') }}
                    </h3>
                </div>
            </a>
        </div>

        <!-- Dynamic Task Components -->
        @foreach($tasks as $task)
            <div class="modern-task-card-wrapper">
                <x-task-component :task="$task" :language="$language" />
            </div>
        @endforeach
    </div>
</div>

