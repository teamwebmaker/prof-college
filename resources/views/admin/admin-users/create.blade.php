@extends('layouts.dashboard')
@section('title', 'ახალი ადმინისტრატორი')
@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="text-dark-red mb-0">ახალი ადმინისტრატორის დამატება</h4>
            <a href="{{ route('admin-users.index', ['language' => app()->getLocale()]) }}" 
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                უკან დაბრუნება
            </a>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin-users.store', ['language' => app()->getLocale()]) }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">სახელი <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">ელ.ფოსტა <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">პაროლი <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            <div class="form-text">მინიმუმ 8 სიმბოლო</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">პაროლის დადასტურება <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">როლი <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="role" 
                                    name="role" 
                                    required>
                                <option value="">აირჩიეთ როლი</option>
                                @if($authAdmin->isSuperAdmin())
                                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>
                                        სუპერ ადმინისტრატორი
                                    </option>
                                @endif
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                    ადმინისტრატორი
                                </option>
                                <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>
                                    რედაქტორი
                                </option>
                            </select>
                            <div class="form-text">
                                <small>
                                    <strong>სუპერ ადმინისტრატორი:</strong> სრული წვდომა<br>
                                    <strong>ადმინისტრატორი:</strong> შინაარსისა და მომხმარებლების მართვა<br>
                                    <strong>რედაქტორი:</strong> მხოლოდ შინაარსის რედაქტირება
                                </small>
                            </div>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">სტატუსი</label>
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    აქტიური ანგარიში
                                </label>
                                <div class="form-text">
                                    მხოლოდ აქტიური ანგარიშები შეძლებენ სისტემაში შესვლას
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin-users.index', ['language' => app()->getLocale()]) }}" 
                       class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i>
                        გაუქმება
                    </a>
                    
                    <button type="submit" class="btn bg-gold text-white">
                        <i class="bi bi-check-circle"></i>
                        ადმინისტრატორის შექმნა
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Password strength indicator (optional enhancement)
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        // You can add visual indicators here
    });

    function calculatePasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        return score;
    }
</script>
@endsection
