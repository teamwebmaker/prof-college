@extends('layouts.dashboard')
@section('title', 'ადმინისტრატორების სია')
@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="text-dark-red mb-0">ადმინისტრატორების მართვა</h4>
            <a href="{{ route('admin-users.create', ['language' => app()->getLocale()]) }}" 
               class="btn bg-gold text-white">
                <i class="bi bi-plus-circle"></i>
                ახალი ადმინისტრატორი
            </a>
        </div>
        
        <div class="card-body">
            <!-- Filters -->
            <form method="GET" class="row mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="ძებნა (სახელი, ელ.ფოსტა)" 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">ყველა როლი</option>
                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>სუპერ ადმინი</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>ადმინი</option>
                        <option value="editor" {{ request('role') == 'editor' ? 'selected' : '' }}>რედაქტორი</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">ყველა სტატუსი</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>აქტიური</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>არააქტიური</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> ძებნა
                    </button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>სახელი</th>
                            <th>ელ.ფოსტა</th>
                            <th>როლი</th>
                            <th>სტატუსი</th>
                            <th>ბოლო შესვლა</th>
                            <th>შექმნის თარიღი</th>
                            <th>მოქმედებები</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adminUsers as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @switch($user->role)
                                    @case('super_admin')
                                        <span class="badge bg-danger">სუპერ ადმინი</span>
                                        @break
                                    @case('admin')
                                        <span class="badge bg-success">ადმინი</span>
                                        @break
                                    @case('editor')
                                        <span class="badge bg-info">რედაქტორი</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">აქტიური</span>
                                @else
                                    <span class="badge bg-secondary">არააქტიური</span>
                                @endif
                            </td>
                            <td>
                                @if($user->last_login_at)
                                    <small>{{ $user->last_login_at->format('d.m.Y H:i') }}</small>
                                @else
                                    <small class="text-muted">არასდროს</small>
                                @endif
                            </td>
                            <td>
                                <small>{{ $user->created_at->format('d.m.Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin-users.show', ['admin_user' => $user->id, 'language' => app()->getLocale()]) }}" 
                                       class="btn btn-outline-info btn-sm" title="ნახვა">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    @if($authAdmin->canManageUsers())
                                        <a href="{{ route('admin-users.edit', ['admin_user' => $user->id, 'language' => app()->getLocale()]) }}" 
                                           class="btn btn-outline-warning btn-sm" title="რედაქტირება">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        @if(!$user->isSuperAdmin() && $user->id != session('admin_user_id'))
                                            <form method="POST" action="{{ route('admin-users.toggle-status', ['admin_user' => $user->id, 'language' => app()->getLocale()]) }}" 
                                                  style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-outline-{{ $user->is_active ? 'secondary' : 'success' }} btn-sm" 
                                                        title="{{ $user->is_active ? 'დეაქტივაცია' : 'აქტივაცია' }}">
                                                    <i class="bi bi-{{ $user->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('admin-users.destroy', ['admin_user' => $user->id, 'language' => app()->getLocale()]) }}" 
                                                  style="display: inline;" 
                                                  onsubmit="return confirm('დარწმუნებული ხართ რომ გსურთ ამ ადმინისტრატორის წაშლა?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="წაშლა">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($adminUsers->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-person-x display-1 text-muted"></i>
                    <h5 class="text-muted mt-3">ადმინისტრატორები არ მოიძებნა</h5>
                </div>
            @endif
            
            {{ $adminUsers->withQueryString()->links() }}
        </div>
    </div>
@endsection
