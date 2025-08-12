<div class="profession-card modern-ui-card">
    <div class="modern-card-header">
        <img src="{{ asset('images/professions/' . $profession->image) }}" class="modern-card-img" alt="{{ $profession->title->$language }}">
        <div class="modern-img-overlay"></div>
    </div>
    <div class="modern-card-body">
        <h5 class="modern-profession-title" data-language="{{ $language }}">
            {{ $profession->title->$language }}
        </h5>
    </div>
    <div class="modern-card-footer">
        <div class="modern-tables-grid">
            @foreach($profession->groups as $group)
                <a href="{{ $group->table }}" target="_blank" class="modern-table-card">
                    <div class="modern-table-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20V20H4V4ZM6 8V12H18V8H6ZM6 14V16H10V14H6ZM12 14V16H18V14H12Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <span class="modern-table-number" data-language="{{ $language }}">
                        {{ $group->number }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</div>
