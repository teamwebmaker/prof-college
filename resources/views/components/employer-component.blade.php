<div class="card employer-card">
    <div class="row g-0">
        <div class="col-sm-4">
            <img src="{{ asset('images/employers/' . $employer -> image) }}" class="img-fluid rounded-start " alt="...">
        </div>
        <div class="col-sm-8">
            <div class="card-body pb-0">
                <p class="card-title fs-6 text-red line-clamp">
                    {{$employer->title}}
                </p>
            </div>
        </div>
    </div>
</div>
