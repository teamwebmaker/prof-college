@once
    @push('styles')
    <link rel="stylesheet" href="{{ asset('styles/components/profession.css') }}" />
    @endpush
@endonce

<div class="profession-card modern-ui-card">
    <div class="modern-card-header">
        <img src="{{ asset('images/professions/' . $profession->image) }}" class="modern-card-img" alt="{{ $profession->title->$language }}">
        <div class="modern-img-overlay"></div>
    </div>
    <div class="modern-card-body">
        <h5 class="modern-profession-title" data-language="{{ $language }}">
            {{ $profession->title->$language }}
            @if ($profession->type->$language)
                <span style="font-size: 0.75rem; color:var(--dark-red)">({{$profession->type->$language}})</span>
            @endif
        </h5>
    </div> 
    <div class="modern-card-footer">
        <div class="modern-tables-grid">
            @foreach($profession->groups as $group)
                <a href="{{ asset('assets/tables/' . $group->table) }}?updated={{ $group->updated_at->format('Y-m-d') }}"
                    data-fancybox="pdf-group-{{ $group->id }}"
                    data-type="iframe"
                    data-preload="false"
                    data-caption="Group {{ $group->number }} - {{ $profession->title->$language }}"
                    class="modern-table-card">
                    <div class="modern-table-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <span class="modern-table-number" data-language="{{ $language }}">
                        {{ $group->number }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</div>
