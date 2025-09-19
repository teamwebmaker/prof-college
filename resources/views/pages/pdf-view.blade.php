@extends('layouts.master')
@section('title', __('static.pages.pdf_view') . '/' . $fileName)
@section('styles')
    <style>        
        .pdf-viewer-container {
            background: var(--light-gray-alt);
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .pdf-header {
            background: var(--white);
            border-bottom: 1px solid var(--light-gray);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        
        .pdf-title {
            color: var(--dark-red);
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            flex: 1;
        }
        
        .pdf-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }
        
        .pdf-actions button,
        .pdf-actions a {
            background: var(--dark-red);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .pdf-actions button:hover,
        .pdf-actions a:hover {
            background: var(--light-red);
            transform: translateY(-1px);
            text-decoration: none;
            color: var(--white);
        }
        
        .pdf-embed-container {
            position: relative;
            width: 100%;
            height: 675px;
            background: var(--white);
        }
        
        #pdf-viewer {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 0 0 8px 8px;
        }
        
        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #666;
            text-align: center;
            font-size: 16px;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
        }
        
        .loading::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-left: 10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--dark-red);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .pdf-header {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            
            .pdf-title {
                text-align: center;
                white-space: normal;
            }
            
            .pdf-actions {
                justify-content: center;
            }
            
            .pdf-embed-container {
                height: 600px;
            }
        }
        
        @media (max-width: 480px) {
            .pdf-actions {
                flex-direction: column;
            }
            
            .pdf-embed-container {
                height: 500px;
            }
        }
    </style>
@endsection

@section('main')
<div class="pdf-viewer-container mb-4">
    <!-- PDF Header -->
    <div class="pdf-header">
        <h3 class="pdf-title" title="{{ $fileName }}">{{ $fileName }}</h3>
        <div class="pdf-actions">
            <a href="{{ asset('docs/static/' . $fileName) }}" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right"></i> Open Original
            </a>
            <a href="{{ asset('docs/static/' . $fileName) }}" download="{{ $fileName }}">
                <i class="bi bi-download"></i> Download
            </a>
            <button onclick="toggleFullscreen()" id="fullscreen-btn">
                <i class="bi bi-fullscreen"></i> Fullscreen
            </button>
        </div>
    </div>
    
    <!-- PDF Embed Container -->
    <div class="pdf-embed-container" id="pdf-container">
        <div id="loading" class="loading">Loading PDF...</div>
        
        <!-- EmbedPDF Viewer Container -->
        <div id="pdf-viewer" style="height: 100%;"></div>
    </div>
</div>

<!-- Fallback message for very old browsers -->
<noscript>
    <div style="text-align: center; padding: 20px; background: var(--light-gray); border-radius: 8px; margin-top: 20px;">
        <p>JavaScript is required for the enhanced PDF viewer. You can still 
        <a href="{{ asset('docs/static/' . $fileName) }}" target="_blank">open the PDF directly here</a>.</p>
    </div>
</noscript>
@endsection

@section('scripts')
    <script async type="module">
        class EmbedPDFViewer {
            constructor() {
                this.container = document.getElementById('pdf-container');
                this.viewer = null;
                this.loadingDiv = document.getElementById('loading');
                this.fullscreenBtn = document.getElementById('fullscreen-btn');
                this.isFullscreen = false;
                this.pdfUrl = '{{ asset('docs/static/' . $fileName) }}';
                this.loadingTimeout = null;
                
                this.initialize();
            }
            
            async initialize() {
                // Set a timeout to fallback if loading takes too long
                this.loadingTimeout = setTimeout(() => {
                    console.log('EmbedPDF loading timeout, falling back to iframe');
                    this.fallbackToIframe();
                }, 10000); // 10 second timeout
                
                try {
                    // Import EmbedPDF dynamically
                    const EmbedPDF = await import('https://snippet.embedpdf.com/embedpdf.js');
                    
                    // Clear timeout if import succeeds
                    if (this.loadingTimeout) {
                        clearTimeout(this.loadingTimeout);
                        this.loadingTimeout = null;
                    }
                    
                    // Initialize EmbedPDF viewer
                    this.viewer = EmbedPDF.default.init({
                        type: 'container',
                        target: document.getElementById('pdf-viewer'),
                        src: this.pdfUrl
                    });
                    
                    // Set another timeout for PDF loading
                    const pdfTimeout = setTimeout(() => {
                        console.log('PDF loading timeout, falling back to iframe');
                        this.fallbackToIframe();
                    }, 15000); // 15 second timeout for PDF loading
                    
                    // Hide loading when PDF is ready
                    if (this.viewer && typeof this.viewer.on === 'function') {
                        this.viewer.on('ready', () => {
                            clearTimeout(pdfTimeout);
                            this.hideLoading();
                            console.log('PDF loaded successfully with EmbedPDF');
                        });
                        
                        this.viewer.on('error', (error) => {
                            clearTimeout(pdfTimeout);
                            console.error('EmbedPDF Error:', error);
                            this.fallbackToIframe();
                        });
                    } else {
                        // If no event system available, just hide loading after delay
                        setTimeout(() => {
                            clearTimeout(pdfTimeout);
                            this.hideLoading();
                        }, 3000);
                    }
                    
                } catch (error) {
                    console.error('Failed to load EmbedPDF:', error);
                    if (this.loadingTimeout) {
                        clearTimeout(this.loadingTimeout);
                        this.loadingTimeout = null;
                    }
                    this.fallbackToIframe();
                }
                
                this.bindEvents();
            }
            
            fallbackToIframe() {
                console.log('Falling back to iframe PDF viewer');
                
                // Clear any existing timeouts
                if (this.loadingTimeout) {
                    clearTimeout(this.loadingTimeout);
                    this.loadingTimeout = null;
                }
                
                // Fallback to traditional iframe if EmbedPDF fails
                const pdfViewerDiv = document.getElementById('pdf-viewer');
                if (pdfViewerDiv) {
                    pdfViewerDiv.innerHTML = `
                        <iframe 
                            style="width: 100%; height: 100%; border: none;" 
                            src="${this.pdfUrl}#toolbar=1&navpanes=1&scrollbar=1&view=FitH"
                            title="PDF Viewer for {{ $fileName }}"
                            loading="lazy"
                            onload="if(window.embedPdfViewer) window.embedPdfViewer.hideLoading();"
                            onerror="if(window.embedPdfViewer) window.embedPdfViewer.showError('Failed to load PDF file');">  
                        </iframe>
                    `;
                }
                
                // Hide loading after a short delay to ensure iframe has started loading
                setTimeout(() => {
                    this.hideLoading();
                }, 2000);
            }
            
            bindEvents() {
                // Fullscreen change events
                document.addEventListener('fullscreenchange', () => {
                    this.updateFullscreenButton();
                });
                
                document.addEventListener('webkitfullscreenchange', () => {
                    this.updateFullscreenButton();
                });
                
                document.addEventListener('mozfullscreenchange', () => {
                    this.updateFullscreenButton();
                });
                
                document.addEventListener('MSFullscreenChange', () => {
                    this.updateFullscreenButton();
                });
                
                // Keyboard shortcuts
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        if (this.isFullscreen) {
                            this.exitFullscreen();
                        }
                    }
                });
            }
            
            hideLoading() {
                if (this.loadingDiv) {
                    this.loadingDiv.style.display = 'none';
                }
            }
            
            showError(message) {
                if (this.loadingDiv) {
                    this.loadingDiv.style.display = 'block';
                    this.loadingDiv.innerHTML = `
                        <div style="color: #dc3545; font-weight: 500;">
                            <i class="bi bi-exclamation-triangle"></i> ${message}
                        </div>
                        <div style="margin-top: 10px; font-size: 14px;">
                            <a href="${this.pdfUrl}" target="_blank" style="color: #dc3545; text-decoration: underline;">
                                Open PDF directly
                            </a>
                        </div>
                    `;
                }
            }
            
            updateFullscreenButton() {
                this.isFullscreen = !!(document.fullscreenElement || 
                                        document.webkitFullscreenElement || 
                                        document.mozFullScreenElement || 
                                        document.msFullscreenElement);
                
                if (this.fullscreenBtn) {
                    this.fullscreenBtn.innerHTML = this.isFullscreen ? 
                        '<i class="bi bi-fullscreen-exit"></i> Exit Fullscreen' : 
                        '<i class="bi bi-fullscreen"></i> Fullscreen';
                }
            }
            
            enterFullscreen() {
                const element = this.container;
                
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            }
            
            exitFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        }
        
        // Global functions
        window.toggleFullscreen = function() {
            const viewer = window.embedPdfViewer;
            if (viewer) {
                if (viewer.isFullscreen) {
                    viewer.exitFullscreen();
                } else {
                    viewer.enterFullscreen();
                }
            }
        }
        
        // Initialize PDF viewer when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.embedPdfViewer = new EmbedPDFViewer();
        });
    </script>
    
    <!-- Fallback script for non-module browsers -->
    <script nomodule>
        // Fallback for browsers that don't support ES modules
        document.addEventListener('DOMContentLoaded', () => {
            const pdfViewerDiv = document.getElementById('pdf-viewer');
            const loadingDiv = document.getElementById('loading');
            
            console.log('Using nomodule fallback for PDF viewer');
            
            if (pdfViewerDiv) {
                pdfViewerDiv.innerHTML = `
                    <iframe 
                        style="width: 100%; height: 100%; border: none;" 
                        src="{{ asset('docs/static/' . $fileName) }}#toolbar=1&navpanes=1&scrollbar=1&view=FitH"
                        title="PDF Viewer for {{ $fileName }}"
                        loading="lazy"
                        onload="document.getElementById('loading').style.display='none';"
                        onerror="console.error('Failed to load PDF iframe');">
                    </iframe>
                `;
            }
            
            // Hide loading after a delay as fallback
            setTimeout(() => {
                if (loadingDiv) {
                    loadingDiv.style.display = 'none';
                }
            }, 5000); // Increased timeout
        });
    </script>
    
    <!-- Additional immediate fallback script -->
    <script>
        // Immediate fallback that runs regardless of module support
        (function() {
            // If after 8 seconds the loading is still visible, force fallback
            setTimeout(function() {
                const loadingDiv = document.getElementById('loading');
                const pdfViewerDiv = document.getElementById('pdf-viewer');
                
                if (loadingDiv && loadingDiv.style.display !== 'none') {
                    console.log('Emergency fallback: Loading still visible after 8 seconds');
                    
                    if (pdfViewerDiv && pdfViewerDiv.innerHTML.trim() === '') {
                        pdfViewerDiv.innerHTML = `
                            <iframe 
                                style="width: 100%; height: 100%; border: none;" 
                                src="{{ asset('docs/static/' . $fileName) }}#toolbar=1&navpanes=1&scrollbar=1&view=FitH"
                                title="PDF Viewer for {{ $fileName }}"
                                loading="lazy">
                            </iframe>
                        `;
                    }
                    
                    loadingDiv.style.display = 'none';
                }
            }, 8000);
            
            // Keep existing Swiper initialization if needed
            if (typeof Swiper !== 'undefined' && typeof swiperSlider !== 'undefined') {
                const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
                const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
            }
        })();
    </script>
@endsection
