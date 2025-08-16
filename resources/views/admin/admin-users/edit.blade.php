@extends('layouts.dashboard')
@section('title', 'ადმინისტრატორის რედაქტირება')
@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="text-dark-red mb-0">ადმინისტრატორის რედაქტირება</h4>
            <div>
                <a href="{{ route('admin-users.show', ['admin_user' => $adminUser->id, 'language' => app()->getLocale()]) }}" 
                   class="btn btn-outline-info me-2">
                    <i class="bi bi-eye"></i>
                    ნახვა
                </a>
                <a href="{{ route('admin-users.index', ['language' => app()->getLocale()]) }}" 
                   class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                    უკან დაბრუნება
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin-users.update', ['admin_user' => $adminUser->id, 'language' => app()->getLocale()]) }}">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">სახელი <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $adminUser->name) }}" 
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
                                   value="{{ old('email', $adminUser->email) }}" 
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
                            <label for="password" class="form-label">ახალი პაროლი</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password">
                            <div class="form-text">დატოვეთ ცარიელი თუ არ გსურთ პაროლის შეცვლა</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">პაროლის დადასტურება</label>
                            <input type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" 
                                   name="password_confirmation">
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
                                    required
                                    {{ (!$authAdmin->isSuperAdmin() && $adminUser->isSuperAdmin()) ? 'disabled' : '' }}>
                                @if($authAdmin->isSuperAdmin() || $adminUser->isSuperAdmin())
                                    <option value="super_admin" {{ old('role', $adminUser->role) == 'super_admin' ? 'selected' : '' }}>
                                        სუპერ ადმინისტრატორი
                                    </option>
                                @endif
                                <option value="admin" {{ old('role', $adminUser->role) == 'admin' ? 'selected' : '' }}>
                                    ადმინისტრატორი
                                </option>
                                <option value="editor" {{ old('role', $adminUser->role) == 'editor' ? 'selected' : '' }}>
                                    რედაქტორი
                                </option>
                            </select>
                            
                            @if(!$authAdmin->isSuperAdmin() && $adminUser->isSuperAdmin())
                                <input type="hidden" name="role" value="{{ $adminUser->role }}">
                                <div class="form-text text-warning">
                                    <i class="bi bi-exclamation-triangle"></i>
                                    მხოლოდ სუპერ ადმინისტრატორს შეუძლია სუპერ ადმინის როლის შეცვლა
                                </div>
                            @endif
                            
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
                                       {{ old('is_active', $adminUser->is_active) ? 'checked' : '' }}
                                       {{ ($adminUser->isSuperAdmin() || $adminUser->id == session('admin_user_id')) ? 'disabled' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    აქტიური ანგარიში
                                </label>
                                
                                @if($adminUser->isSuperAdmin() || $adminUser->id == session('admin_user_id'))
                                    <input type="hidden" name="is_active" value="1">
                                    <div class="form-text text-warning">
                                        <i class="bi bi-exclamation-triangle"></i>
                                        {{ $adminUser->isSuperAdmin() ? 'სუპერ ადმინისტრატორი ყოველთვის აქტიურია' : 'თქვენი საკუთარი ანგარიში ყოველთვის აქტიურია' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">ანგარიშის ინფორმაცია</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="text-muted">შექმნის თარიღი:</small><br>
                                        <strong>{{ $adminUser->created_at->format('d.m.Y H:i') }}</strong>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">ბოლო შესვლა:</small><br>
                                        @if($adminUser->last_login_at)
                                            <strong>{{ $adminUser->last_login_at->format('d.m.Y H:i') }}</strong>
                                        @else
                                            <strong class="text-muted">არასდროს</strong>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">IP მისამართი:</small><br>
                                        <strong>{{ $adminUser->last_login_ip ?? 'N/A' }}</strong>
                                    </div>
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
                        ცვლილებების შენახვა
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Show/hide password confirmation based on password input
    document.getElementById('password').addEventListener('input', function() {
        const confirmField = document.getElementById('password_confirmation');
        if (this.value.length > 0) {
            confirmField.required = true;
            confirmField.parentElement.querySelector('label').innerHTML = 'პაროლის დადასტურება <span class="text-danger">*</span>';
        } else {
            confirmField.required = false;
            confirmField.parentElement.querySelector('label').innerHTML = 'პაროლის დადასტურება';
        }
    });
</script>
@endsection
