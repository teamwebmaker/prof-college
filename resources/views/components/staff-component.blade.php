<div class="card staff-card">
    <div class="card-header p-0 staff-card-header">
        <img src="{{ asset('images/staff/' . $staff -> image) }}" class="card-img-top response-img zoom-effect" alt="...">
    </div>
    <div class="card-body staff-card-body">
        <h5 class="card-title">{{ $staff -> full_name -> $language }}</h5>
        <p class="card-text">{{ $staff -> position -> $language }}</p>
    </div>
</div>
