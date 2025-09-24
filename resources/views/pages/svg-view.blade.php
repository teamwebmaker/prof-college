@extends('layouts.master')
@section('title', __('static.pages.svg_view') . '/' . $fileName)
@section('styles')
    <style>        
        .svg-viewer-container {
            background: var(--light-gray-alt);
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .svg-header {
            background: var(--white);
            border-bottom: 1px solid var(--light-gray);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        
        .svg-title {
            color: var(--dark-red);
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            flex: 1;
        }
        
        .svg-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }
        
        .svg-actions button,
        .svg-actions a {
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
        
        .svg-actions button:hover,
        .svg-actions a:hover {
            background: var(--light-red);
            transform: translateY(-1px);
            text-decoration: none;
            color: var(--white);
        }
        
        .svg-actions button:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }
        
        .svg-embed-container {
            position: relative;
            width: 100%;
            height: 675px;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        #svg-viewer {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0 0 8px 8px;
            position: relative;
        }
        
        .svg-content {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.2s ease;
        }
        
        .svg-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            border-radius: 25px;
            padding: 10px 20px;
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 10;
        }
        
        .svg-embed-container:hover .svg-controls {
            opacity: 1;
        }
        
        .svg-controls button {
            background: transparent;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }
        
        .svg-controls button:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .zoom-info {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .svg-embed-container:hover .zoom-info {
            opacity: 1;
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
        
        .error-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #dc3545;
            text-align: center;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 8px;
            border: 2px solid #dc3545;
            max-width: 400px;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .svg-header {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
            }
            
            .svg-title {
                text-align: center;
                white-space: normal;
            }
            
            .svg-actions {
                justify-content: center;
            }
            
            .svg-embed-container {
                height: 600px;
            }
            
            .svg-controls {
                bottom: 10px;
                padding: 8px 15px;
                gap: 8px;
            }
            
            .svg-controls button {
                padding: 6px 10px;
                font-size: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .svg-actions {
                flex-direction: column;
            }
            
            .svg-embed-container {
                height: 500px;
            }
            
            .svg-controls {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
        
        /* Fullscreen styles */
        .svg-viewer-container:-webkit-full-screen,
        .svg-viewer-container:-moz-full-screen,
        .svg-viewer-container:-ms-fullscreen,
        .svg-viewer-container:fullscreen {
            width: 100vw;
            height: 100vh;
            border-radius: 0;
        }
        
        .svg-viewer-container:-webkit-full-screen .svg-embed-container,
        .svg-viewer-container:-moz-full-screen .svg-embed-container,
        .svg-viewer-container:-ms-fullscreen .svg-embed-container,
        .svg-viewer-container:fullscreen .svg-embed-container {
            height: calc(100vh - 80px);
        }
    </style>
@endsection

@section('main')
<div class="svg-viewer-container mb-4">
    <!-- SVG Header -->
    <div class="svg-header">
        <h3 class="svg-title" title="{{ $fileName }}">{{ $fileName }}</h3>
        <div class="svg-actions">
            <a href="{{ asset('docs/static/' . $fileName) }}" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right"></i> Open Original
            </a>
            <a href="{{ asset('docs/static/' . $fileName) }}" download="{{ $fileName }}">
                <i class="bi bi-download"></i> Download
            </a>
            <button onclick="copyToClipboard()" id="copy-btn">
                <i class="bi bi-clipboard"></i> Copy URL
            </button>
            <button onclick="toggleFullscreen()" id="fullscreen-btn">
                <i class="bi bi-fullscreen"></i> Fullscreen
            </button>
        </div>
    </div>
    
    <!-- SVG Embed Container -->
    <div class="svg-embed-container" id="svg-container">
        <div id="loading" class="loading">Loading SVG...</div>
        
        <!-- SVG Viewer Container -->
        <div id="svg-viewer">
            <!-- SVG content will be loaded here -->
        </div>
        
        <!-- Zoom Controls -->
        <div class="svg-controls" id="svg-controls">
            <button onclick="resetZoom()" title="Reset Zoom">
                <i class="bi bi-arrow-clockwise"></i> Reset
            </button>
            <button onclick="zoomIn()" title="Zoom In">
                <i class="bi bi-zoom-in"></i>
            </button>
            <button onclick="zoomOut()" title="Zoom Out">
                <i class="bi bi-zoom-out"></i>
            </button>
            <button onclick="fitToScreen()" title="Fit to Screen">
                <i class="bi bi-arrows-angle-contract"></i> Fit
            </button>
        </div>
        
        <!-- Zoom Info -->
        <div class="zoom-info" id="zoom-info">100%</div>
    </div>
</div>

<!-- Fallback message for very old browsers -->
<noscript>
    <div style="text-align: center; padding: 20px; background: var(--light-gray); border-radius: 8px; margin-top: 20px;">
        <p>JavaScript is required for the enhanced SVG viewer. You can still 
        <a href="{{ asset('docs/static/' . $fileName) }}" target="_blank">open the SVG directly here</a>.</p>
    </div>
</noscript>
@endsection

@section('scripts')
    <script>
        class SVGViewer {
            constructor() {
                this.container = document.getElementById('svg-container');
                this.viewer = document.getElementById('svg-viewer');
                this.loadingDiv = document.getElementById('loading');
                this.fullscreenBtn = document.getElementById('fullscreen-btn');
                this.copyBtn = document.getElementById('copy-btn');
                this.zoomInfo = document.getElementById('zoom-info');
                this.controls = document.getElementById('svg-controls');
                
                this.isFullscreen = false;
                this.currentZoom = 1;
                this.svgElement = null;
                this.svgUrl = '{{ asset('docs/static/' . $fileName) }}';
                this.isDragging = false;
                this.dragStart = { x: 0, y: 0 };
                this.translateX = 0;
                this.translateY = 0;
                
                this.initialize();
            }
            
            async initialize() {
                try {
                    await this.loadSVG();
                    this.bindEvents();
                    this.hideLoading();
                } catch (error) {
                    console.error('Failed to load SVG:', error);
                    this.showError('Failed to load SVG file');
                }
            }
            
            async loadSVG() {
                try {
                    const response = await fetch(this.svgUrl);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    const svgText = await response.text();
                    
                    // Create a container div for the SVG
                    const svgContainer = document.createElement('div');
                    svgContainer.innerHTML = svgText;
                    svgContainer.className = 'svg-content';
                    svgContainer.style.cssText = `
                        width: 100%;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: grab;
                    `;
                    
                    // Get the actual SVG element
                    this.svgElement = svgContainer.querySelector('svg');
                    
                    if (this.svgElement) {
                        // Ensure SVG is properly sized
                        this.svgElement.style.cssText = `
                            max-width: 100%;
                            max-height: 100%;
                            width: auto;
                            height: auto;
                        `;
                        
                        // Preserve aspect ratio
                        if (!this.svgElement.hasAttribute('viewBox')) {
                            const width = this.svgElement.getAttribute('width') || '100';
                            const height = this.svgElement.getAttribute('height') || '100';
                            this.svgElement.setAttribute('viewBox', `0 0 ${width} ${height}`);
                        }
                        
                        this.svgElement.setAttribute('preserveAspectRatio', 'xMidYMid meet');
                    }
                    
                    // Clear the viewer and add the SVG
                    this.viewer.innerHTML = '';
                    this.viewer.appendChild(svgContainer);
                    
                    console.log('SVG loaded successfully');
                    
                } catch (error) {
                    console.error('Error loading SVG:', error);
                    throw error;
                }
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
                
                // Mouse wheel zoom
                this.viewer.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    const delta = e.deltaY > 0 ? -0.1 : 0.1;
                    this.zoom(delta);
                });
                
                // Drag functionality
                this.viewer.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    this.isDragging = true;
                    this.dragStart = { x: e.clientX - this.translateX, y: e.clientY - this.translateY };
                    this.viewer.style.cursor = 'grabbing';
                });
                
                document.addEventListener('mousemove', (e) => {
                    if (!this.isDragging) return;
                    e.preventDefault();
                    this.translateX = e.clientX - this.dragStart.x;
                    this.translateY = e.clientY - this.dragStart.y;
                    this.updateTransform();
                });
                
                document.addEventListener('mouseup', () => {
                    this.isDragging = false;
                    this.viewer.style.cursor = 'grab';
                });
                
                // Keyboard shortcuts
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.isFullscreen) {
                        this.exitFullscreen();
                    } else if (e.key === '+' || e.key === '=') {
                        e.preventDefault();
                        this.zoom(0.1);
                    } else if (e.key === '-') {
                        e.preventDefault();
                        this.zoom(-0.1);
                    } else if (e.key === '0') {
                        e.preventDefault();
                        this.resetZoom();
                    }
                });
                
                // Touch events for mobile
                this.bindTouchEvents();
            }
            
            bindTouchEvents() {
                let initialDistance = 0;
                let initialZoom = 1;
                
                this.viewer.addEventListener('touchstart', (e) => {
                    if (e.touches.length === 2) {
                        // Pinch zoom start
                        initialDistance = this.getDistance(e.touches[0], e.touches[1]);
                        initialZoom = this.currentZoom;
                    } else if (e.touches.length === 1) {
                        // Single touch drag start
                        this.isDragging = true;
                        const touch = e.touches[0];
                        this.dragStart = { x: touch.clientX - this.translateX, y: touch.clientY - this.translateY };
                    }
                });
                
                this.viewer.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                    
                    if (e.touches.length === 2) {
                        // Pinch zoom
                        const currentDistance = this.getDistance(e.touches[0], e.touches[1]);
                        const scale = currentDistance / initialDistance;
                        this.setZoom(initialZoom * scale);
                    } else if (e.touches.length === 1 && this.isDragging) {
                        // Single touch drag
                        const touch = e.touches[0];
                        this.translateX = touch.clientX - this.dragStart.x;
                        this.translateY = touch.clientY - this.dragStart.y;
                        this.updateTransform();
                    }
                });
                
                this.viewer.addEventListener('touchend', () => {
                    this.isDragging = false;
                });
            }
            
            getDistance(touch1, touch2) {
                const dx = touch1.clientX - touch2.clientX;
                const dy = touch1.clientY - touch2.clientY;
                return Math.sqrt(dx * dx + dy * dy);
            }
            
            zoom(delta) {
                const newZoom = Math.max(0.1, Math.min(5, this.currentZoom + delta));
                this.setZoom(newZoom);
            }
            
            setZoom(zoom) {
                this.currentZoom = zoom;
                this.updateTransform();
                this.updateZoomInfo();
            }
            
            updateTransform() {
                const svgContent = this.viewer.querySelector('.svg-content');
                if (svgContent) {
                    svgContent.style.transform = `translate(${this.translateX}px, ${this.translateY}px) scale(${this.currentZoom})`;
                }
            }
            
            updateZoomInfo() {
                if (this.zoomInfo) {
                    this.zoomInfo.textContent = Math.round(this.currentZoom * 100) + '%';
                }
            }
            
            resetZoom() {
                this.currentZoom = 1;
                this.translateX = 0;
                this.translateY = 0;
                this.updateTransform();
                this.updateZoomInfo();
            }
            
            fitToScreen() {
                if (!this.svgElement) return;
                
                const containerRect = this.viewer.getBoundingClientRect();
                const svgRect = this.svgElement.getBoundingClientRect();
                
                const scaleX = (containerRect.width - 40) / svgRect.width;
                const scaleY = (containerRect.height - 40) / svgRect.height;
                const scale = Math.min(scaleX, scaleY, 1);
                
                this.currentZoom = scale;
                this.translateX = 0;
                this.translateY = 0;
                this.updateTransform();
                this.updateZoomInfo();
            }
            
            hideLoading() {
                if (this.loadingDiv) {
                    this.loadingDiv.style.display = 'none';
                }
            }
            
            showError(message) {
                if (this.loadingDiv) {
                    this.loadingDiv.innerHTML = `
                        <div class="error-message">
                            <div style="color: #dc3545; font-weight: 500; margin-bottom: 10px;">
                                <i class="bi bi-exclamation-triangle"></i> ${message}
                            </div>
                            <div style="font-size: 14px;">
                                <a href="${this.svgUrl}" target="_blank" style="color: #dc3545; text-decoration: underline;">
                                    Open SVG directly
                                </a>
                            </div>
                        </div>
                    `;
                }
            }
            
            async copyToClipboard() {
                try {
                    await navigator.clipboard.writeText(window.location.href);
                    
                    // Show feedback
                    const originalText = this.copyBtn.innerHTML;
                    this.copyBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
                    this.copyBtn.disabled = true;
                    
                    setTimeout(() => {
                        this.copyBtn.innerHTML = originalText;
                        this.copyBtn.disabled = false;
                    }, 2000);
                    
                } catch (error) {
                    console.error('Failed to copy URL:', error);
                    // Fallback for older browsers
                    const textArea = document.createElement('textarea');
                    textArea.value = window.location.href;
                    document.body.appendChild(textArea);
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        const originalText = this.copyBtn.innerHTML;
                        this.copyBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
                        setTimeout(() => {
                            this.copyBtn.innerHTML = originalText;
                        }, 2000);
                    } catch (fallbackError) {
                        console.error('Fallback copy failed:', fallbackError);
                    }
                    document.body.removeChild(textArea);
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
            const viewer = window.svgViewer;
            if (viewer) {
                if (viewer.isFullscreen) {
                    viewer.exitFullscreen();
                } else {
                    viewer.enterFullscreen();
                }
            }
        }
        
        window.zoomIn = function() {
            const viewer = window.svgViewer;
            if (viewer) viewer.zoom(0.2);
        }
        
        window.zoomOut = function() {
            const viewer = window.svgViewer;
            if (viewer) viewer.zoom(-0.2);
        }
        
        window.resetZoom = function() {
            const viewer = window.svgViewer;
            if (viewer) viewer.resetZoom();
        }
        
        window.fitToScreen = function() {
            const viewer = window.svgViewer;
            if (viewer) viewer.fitToScreen();
        }
        
        window.copyToClipboard = function() {
            const viewer = window.svgViewer;
            if (viewer) viewer.copyToClipboard();
        }
        
        // Initialize SVG viewer when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.svgViewer = new SVGViewer();
        });
        
        // Keep existing Swiper initialization if needed
        if (typeof Swiper !== 'undefined' && typeof swiperSlider !== 'undefined') {
            document.addEventListener('DOMContentLoaded', () => {
                const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
                const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
            });
        }
    </script>
@endsection