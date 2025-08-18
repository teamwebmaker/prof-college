@extends('layouts.master')

@section('main')
@php
    $language = app()->getLocale();
@endphp
<div class="sitemap-container">
    <div class="sitemap-header text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-3" data-language="{{ $language }}">
            <i class="fas fa-sitemap me-3"></i>{{ __('sitemap.page_title', ['default' => 'Site Map']) }}
        </h1>
        <p class="lead text-muted" data-language="{{ $language }}">{{ __('sitemap.page_description', ['default' => 'Navigate through all sections of our professional college website']) }}</p>
    </div>

    <div class="row g-4">
        @foreach($sitemapData as $sectionKey => $section)
            <div class="col-lg-6 col-md-12">
                <div class="sitemap-section h-100">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-primary text-white py-3">
                            <h3 class="card-title h5 mb-0" data-language="{{ $language }}">
                                <i class="fas fa-folder-open me-2"></i>
                                {{ $section['title'] }}
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach($section['routes'] as $routeItem)
                                    <a href="{{ route($routeItem['route'], ['language' => app()->getLocale()]) }}"
                                        target="_blank"
                                        class="list-group-item list-group-item-action d-flex align-items-center py-3 px-4 border-0 sitemap-link">
                                        <div class="sitemap-icon me-3">
                                            <i class="{{ $routeItem['icon'] }} fa-lg text-primary"></i>
                                        </div>
                                        <div class="sitemap-link-content flex-grow-1">
                                            <h6 class="mb-1 fw-semibold" data-language="{{ $language }}">{{ $routeItem['name'] }}</h6>
                                            <small class="text-muted">{{ route($routeItem['route'], ['language' => app()->getLocale()]) }}</small>
                                        </div>
                                        <div class="sitemap-arrow">
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Additional Information Section -->
    <div class="sitemap-footer mt-5 pt-4 border-top">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h4 class="h5 fw-bold mb-3" data-language="{{ $language }}">{{ __('sitemap.additional_info', ['default' => 'Additional Information']) }}</h4>
                <p class="text-muted" data-language="{{ $language }}">
                    {{ __('sitemap.footer_text', ['default' => 'This sitemap provides quick access to all public sections of our professional college website. For administrative functions, please contact the administration.']) }}
                </p>

                <div class="sitemap-stats mt-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="stat-item bg-light rounded-3 p-3">
                                <i class="fas fa-globe fa-2x text-primary mb-2"></i>
                                <div class="h6 mb-1" data-language="{{ $language }}">{{ __('sitemap.total_sections', ['default' => 'Total Sections']) }}</div>
                                <div class="fw-bold text-primary">{{ count($sitemapData) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item bg-light rounded-3 p-3">
                                <i class="fas fa-link fa-2x text-success mb-2"></i>
                                <div class="h6 mb-1" data-language="{{ $language }}">{{ __('sitemap.total_pages', ['default' => 'Total Pages']) }}</div>
                                <div class="fw-bold text-success">{{ collect($sitemapData)->sum(fn($section) => count($section['routes'])) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item bg-light rounded-3 p-3">
                                <i class="fas fa-language fa-2x text-info mb-2"></i>
                                <div class="h6 mb-1" data-language="{{ $language }}">{{ __('sitemap.languages', ['default' => 'Languages']) }}</div>
                                <div class="fw-bold text-info">{{ __('sitemap.lang_count', ['default' => '2']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --main-color: hsl(1, 60%, 45%);
    --secondary-color: hsl(43, 55%, 50%);
    --main-color-rgb: 184, 46, 46;
    --secondary-color-rgb: 197, 166, 89;
}

.sitemap-container {
    padding: 2rem 0;
}

.sitemap-header {
    margin-bottom: 3rem;
}

.sitemap-header h1 {
    color: var(--main-color) !important;
}

.sitemap-section .card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.sitemap-section .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(var(--main-color-rgb), 0.15) !important;
}

.sitemap-link {
    transition: all 0.2s ease-in-out;
    border-left: 3px solid transparent;
}

.sitemap-link:hover {
    background-color: #f8f9fa;
    border-left-color: var(--main-color);
    transform: translateX(5px);
}

.sitemap-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
}

.sitemap-icon i {
    color: var(--main-color) !important;
}

.sitemap-link:hover .sitemap-icon {
    background: linear-gradient(135deg, var(--main-color) 0%, hsl(1, 60%, 35%) 100%);
    color: white;
}

.sitemap-link:hover .sitemap-icon i {
    color: white !important;
}

.sitemap-arrow {
    transition: transform 0.2s ease-in-out;
}

.sitemap-link:hover .sitemap-arrow {
    transform: translateX(5px);
}

.stat-item {
    transition: all 0.2s ease-in-out;
    border: 1px solid #e9ecef;
}

.stat-item:hover {
    transform: translateY(-2px);
    border-color: var(--main-color);
    box-shadow: 0 4px 15px rgba(var(--main-color-rgb), 0.1);
}

.stat-item .fas.fa-globe {
    color: var(--main-color) !important;
}

.stat-item .fas.fa-link {
    color: var(--secondary-color) !important;
}

.stat-item .fas.fa-language {
    color: hsl(200, 60%, 50%) !important;
}

.fw-bold.text-primary {
    color: var(--main-color) !important;
}

.fw-bold.text-success {
    color: var(--secondary-color) !important;
}

.card-header {
    background: linear-gradient(135deg, var(--main-color) 0%, hsl(1, 60%, 35%) 100%) !important;
    border-radius: 8px 8px 0 0 !important;
}

/* Georgian Font Family */
[data-language="ka"] {
    font-family: "algeti" !important;
}

@media (max-width: 768px) {
    .sitemap-header h1 {
        font-size: 2rem;
    }

    .sitemap-link {
        padding: 1rem !important;
    }

    .sitemap-icon {
        width: 40px;
        height: 40px;
    }
}

/* RTL Support for Georgian text */
[dir="rtl"] .sitemap-link:hover {
    transform: translateX(-5px);
}

[dir="rtl"] .sitemap-arrow {
    transform: scaleX(-1);
}

[dir="rtl"] .sitemap-link:hover .sitemap-arrow {
    transform: scaleX(-1) translateX(5px);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling for better UX
    document.querySelectorAll('.sitemap-link').forEach(link => {
        link.addEventListener('click', function(e) {
            // Add a subtle loading effect
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 200);
        });
    });

    // Add animation on load
    const cards = document.querySelectorAll('.sitemap-section .card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
</script>
@endsection
