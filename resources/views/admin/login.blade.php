<!doctype html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body data-languge="en">
<div class="container-fluid py-5">
    <div class="container">
        <h2 class="card-title text-center mb-4 fw-bold text-secondary">
            <i class="bi bi-door-open-fill"></i>
            <span class="title-label">
                    ავტორიზაცია
                </span>
        </h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Success Messages -->
                @if(session('success'))
                    <div class="alert alert-success mb-3" role="alert">
                        <i class="bi bi-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                <!-- Error Messages -->
                @if(session('error'))
                    <div class="alert alert-danger mb-3" role="alert">
                        <i class="bi bi-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('admin.auth', ['language' => app() -> getLocale()]) }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="ელექტრონული ფოსტა" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required/>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @session('email')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $value }}
                        </div>
                        @endsession
                    </div>
                    <div class="mb-3">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="პაროლი" 
                               name="password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @session('password')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{ $value }}
                        </div>
                        @endsession
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn bg-gold text-white">
                            <i class="bi bi-box-arrow-in-right"></i>
                            შესვლა
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
</body>
</html>
