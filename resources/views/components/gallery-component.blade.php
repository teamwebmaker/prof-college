<div class="gallery-row mb-5">
    <h5 class="section-title mb-4 text-red">
        <span class="section-title-label pb-2" data-language="{{ $language }}">{{ $item->title->$language }}</span>
    </h5>
    <div class="row">
        @foreach($item->gallery_images as $image)
            <div class="col-md-3 mb-4">
                <div class="card gallery-card">
                    <a class="gallery-link" href="{{ asset(join('/', ['images/galleries', $item->uuid, $image->image])) }}"
                        data-fancybox="{{ 'gallery-' . $item->id }}"
                        data-caption="Single image">
                        <img class="response-img gallery-image"
                            src="{{ asset(join('/', ['images/galleries', $item->uuid, $image->image])) }}"
                            alt="Gallery image" />
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
