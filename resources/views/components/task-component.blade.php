<div class="card task-card">
    <div class="card-header task-card-header p-0">
        <a class="d-block content-overlay" data-content="{{ $task->title->$language }}" href="{{ $task->url }}" target="_blank">
            <img src="{{ asset('images/tasks/' . $task->image) }}" class="card-img-top response-img" alt="{{ $task->title->$language }}" />
        </a>
    </div>
    <div class="card-body task-card-body py-2">
        <h5 class="card-title truncate text-red"
            title="{{ $task->title->$language }}"
            data-language="{{ $language }}">
            {{ $task->title->$language }}
        </h5>
    </div>
</div>
