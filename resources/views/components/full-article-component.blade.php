<div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text"></p>
    </div>
</div>
<div class="row">
    @foreach($docs as $doc)
        <div class="col-md-4">
            <a>
                <img src="{{ asset('images/formats/' . implode('.',[$doc -> type, 'png'])) }}" class="img-thumbnail" alt="...">
            </a>
        </div>
    @endforeach
</div>
