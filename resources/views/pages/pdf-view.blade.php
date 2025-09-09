@extends('layouts.master')
@section('title', __('static.pages.pdf_view') . '/' . $fileName)
@section('styles')
    <style>        
        .pdf-viewer-container {
            background: var(--light-gray-alt);
            position: relative;
        }
        
        .pdf-controls {
            background: var(--white);
            border-bottom: 1px solid var(--light-gray);
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
            border-radius: 8px 8px 0 0;
        }
        
        .pdf-controls button {
            background: var(--dark-red);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        
        .pdf-controls button:hover {
            background: var(--light-red);
            transform: translateY(-1px);
        }
        
        .pdf-controls button:disabled {
            background: var(--light-gray);
            color: #888;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .pdf-controls input {
            width: 60px;
            padding: 5px;
            text-align: center;
            border: 1px solid var(--light-gray);
            background: var(--white);
            color: #333;
            border-radius: 3px;
            transition: border-color 0.2s ease;
        }
        
        .pdf-controls input:focus {
            outline: none;
            border-color: var(--dark-red);
        }
        
        .pdf-controls .page-info {
            color: var(--light-gray);
            font-size: 14px;
        }
        
        .pdf-canvas-container {
            flex: 1;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            border-radius: 0 0 8px 8px;
        }
        
        #pdf-canvas {
            max-width: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            background: var(--white);
        }
        
        .loading {
            color: #666;
            text-align: center;
            padding: 50px;
            font-size: 16px;
        }
        
        .error {
            color: var(--dark-red);
            text-align: center;
            padding: 50px;
            font-size: 16px;
        }
        
        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .zoom-level {
            color: #666;
            font-size: 14px;
            min-width: 50px;
            text-align: center;
            font-weight: 500;
        }
    </style>
@endsection

@section('main')
<div class="pdf-viewer-container mb-4 d-flex flex-column">
    <!-- PDF Controls -->
    <div class="pdf-controls">
        <button id="prev-page" disabled>← Previous</button>
        <div class="page-info">
            Page <input type="number" id="page-input" min="1" value="1"> of <span id="total-pages">-</span>
        </div>
        <button id="next-page" disabled>Next →</button>
        
        <div class="zoom-controls">
            <button id="zoom-out">-</button>
            <span class="zoom-level" id="zoom-level">100%</span>
            <button id="zoom-in">+</button>
            <button id="fit-width">Fit Width</button>
            <button id="actual-size">100%</button>
        </div>
    </div>
    
    <!-- PDF Canvas Container -->
    <div class="pdf-canvas-container">
        <div id="loading" class="loading">Loading PDF...</div>
        <div id="error" class="error" style="display: none;">Error loading PDF. Please try again.</div>
        <canvas id="pdf-canvas" style="display: none;"></canvas>
    </div>
</div>
@endsection

@section('scripts')
    <!-- PDF.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        // PDF.js configuration
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        
        class PDFViewer {
            constructor() {
                this.pdfDoc = null;
                this.pageNum = 1;
                this.pageIsRendering = false;
                this.pageNumPending = null;
                this.scale = 1.2;
                this.canvas = document.getElementById('pdf-canvas');
                this.ctx = this.canvas.getContext('2d', { willReadFrequently: true });
                this.pdfUrl = '{{ asset('docs/static/' . $fileName) }}';
                
                this.initializeElements();
                this.bindEvents();
                this.loadPDF();
            }
            
            initializeElements() {
                this.prevBtn = document.getElementById('prev-page');
                this.nextBtn = document.getElementById('next-page');
                this.pageInput = document.getElementById('page-input');
                this.totalPagesSpan = document.getElementById('total-pages');
                this.zoomInBtn = document.getElementById('zoom-in');
                this.zoomOutBtn = document.getElementById('zoom-out');
                this.fitWidthBtn = document.getElementById('fit-width');
                this.actualSizeBtn = document.getElementById('actual-size');
                this.zoomLevelSpan = document.getElementById('zoom-level');
                this.loadingDiv = document.getElementById('loading');
                this.errorDiv = document.getElementById('error');
            }
            
            bindEvents() {
                this.prevBtn.addEventListener('click', () => this.showPrevPage());
                this.nextBtn.addEventListener('click', () => this.showNextPage());
                this.pageInput.addEventListener('change', () => this.goToPage());
                this.pageInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') this.goToPage();
                });
                this.zoomInBtn.addEventListener('click', () => this.zoomIn());
                this.zoomOutBtn.addEventListener('click', () => this.zoomOut());
                this.fitWidthBtn.addEventListener('click', () => this.fitToWidth());
                this.actualSizeBtn.addEventListener('click', () => this.actualSize());
                
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.target.tagName === 'INPUT') return; // Don't interfere with input fields
                    
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        this.showPrevPage();
                    }
                    if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        this.showNextPage();
                    }
                    if (e.key === '=' || e.key === '+') {
                        e.preventDefault();
                        this.zoomIn();
                    }
                    if (e.key === '-') {
                        e.preventDefault();
                        this.zoomOut();
                    }
                });
                
                // Mouse wheel zoom
                this.canvas.addEventListener('wheel', (e) => {
                    if (e.ctrlKey) {
                        e.preventDefault();
                        if (e.deltaY < 0) {
                            this.zoomIn();
                        } else {
                            this.zoomOut();
                        }
                    }
                });
            }
            
            async loadPDF() {
                try {
                    this.pdfDoc = await pdfjsLib.getDocument(this.pdfUrl).promise;
                    this.totalPagesSpan.textContent = this.pdfDoc.numPages;
                    this.pageInput.max = this.pdfDoc.numPages;
                    
                    this.loadingDiv.style.display = 'none';
                    this.canvas.style.display = 'block';
                    
                    await this.renderPage(this.pageNum);
                    this.updateControls();
                    this.updateZoomDisplay();
                } catch (error) {
                    console.error('Error loading PDF:', error);
                    this.loadingDiv.style.display = 'none';
                    this.errorDiv.style.display = 'block';
                }
            }
            
            async renderPage(num) {
                if (!this.pdfDoc) return;
                
                this.pageIsRendering = true;
                
                try {
                    const page = await this.pdfDoc.getPage(num);
                    const viewport = page.getViewport({ scale: this.scale });
                    
                    this.canvas.height = viewport.height;
                    this.canvas.width = viewport.width;
                    
                    // Clear canvas before rendering
                    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                    
                    const renderContext = {
                        canvasContext: this.ctx,
                        viewport: viewport
                    };
                    
                    await page.render(renderContext).promise;
                    
                    this.pageIsRendering = false;
                    
                    if (this.pageNumPending !== null) {
                        const pendingPage = this.pageNumPending;
                        this.pageNumPending = null;
                        await this.renderPage(pendingPage);
                    }
                } catch (error) {
                    console.error('Error rendering page:', error);
                    this.pageIsRendering = false;
                }
            }
            
            queueRenderPage(num) {
                if (this.pageIsRendering) {
                    this.pageNumPending = num;
                } else {
                    this.renderPage(num);
                }
            }
            
            showPrevPage() {
                if (this.pageNum <= 1) return;
                this.pageNum--;
                this.pageInput.value = this.pageNum;
                this.queueRenderPage(this.pageNum);
                this.updateControls();
            }
            
            showNextPage() {
                if (this.pageNum >= this.pdfDoc.numPages) return;
                this.pageNum++;
                this.pageInput.value = this.pageNum;
                this.queueRenderPage(this.pageNum);
                this.updateControls();
            }
            
            goToPage() {
                const page = parseInt(this.pageInput.value);
                if (page >= 1 && page <= this.pdfDoc.numPages) {
                    this.pageNum = page;
                    this.queueRenderPage(this.pageNum);
                    this.updateControls();
                } else {
                    this.pageInput.value = this.pageNum;
                }
            }
            
            zoomIn() {
                this.scale = Math.min(this.scale + 0.25, 5.0); // Max zoom 500%
                this.updateZoom();
            }
            
            zoomOut() {
                this.scale = Math.max(this.scale - 0.25, 0.25); // Min zoom 25%
                this.updateZoom();
            }
            
            async fitToWidth() {
                if (!this.pdfDoc) return;
                
                const container = document.querySelector('.pdf-canvas-container');
                const containerWidth = container.clientWidth - 40; // padding
                
                try {
                    const page = await this.pdfDoc.getPage(this.pageNum);
                    const viewport = page.getViewport({ scale: 1 });
                    this.scale = containerWidth / viewport.width;
                    this.updateZoom();
                } catch (error) {
                    console.error('Error fitting to width:', error);
                }
            }
            
            actualSize() {
                this.scale = 1;
                this.updateZoom();
            }
            
            updateZoom() {
                this.updateZoomDisplay();
                this.queueRenderPage(this.pageNum);
            }
            
            updateZoomDisplay() {
                this.zoomLevelSpan.textContent = Math.round(this.scale * 100) + '%';
            }
            
            updateControls() {
                if (!this.pdfDoc) return;
                this.prevBtn.disabled = this.pageNum <= 1;
                this.nextBtn.disabled = this.pageNum >= this.pdfDoc.numPages;
                this.zoomOutBtn.disabled = this.scale <= 0.25;
                this.zoomInBtn.disabled = this.scale >= 5.0;
            }
        }
        
        // Initialize PDF viewer when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new PDFViewer();
        });
        const swiperSliderInit = new Swiper(".swiper-slider", swiperSlider);
        const swiperPartnerInit = new Swiper(".swiper-partner", swiperPartner);
    </script>
@endsection


