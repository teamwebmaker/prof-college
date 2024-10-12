<div class="card table-card">
    <div class="card-header p-0 table-card-header">
        <img src="{{ asset('images/professions/' . $profession -> image)}}" class="response-img" alt="...">
    </div>
    <div class="card-body table-card-body">
        <h5 class="profession-title line-clamp text-red">{{ $profession -> title -> $language }}</h5>
    </div>
    <div class="card-footer table-card-footer bg-transparent">
        <ul class="list-group list-group-flush">
        @foreach($profession -> groups as $group)
                <li class="list-group-item table-list-item">
                    <div class="card group-card">
                        <a class="table-link" href="{{ $group -> table }}" target="_blank">
                            <i class="bi bi-table"></i>
                            <span class="table-title">{{ $group -> number }}</span>
                        </a>
                    </div>
                </li>
        @endforeach
        </ul>
    </div>
</div>
