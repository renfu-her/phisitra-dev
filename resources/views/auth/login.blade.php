@extends('layouts.app')

@section('title', '登入/註冊 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <ul class="nav nav-tabs card-header-tabs" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">
                                登入
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">
                                註冊
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="authTabsContent">
                        <!-- 登入表單 -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form method="POST" action="{{ route('login.submit') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="login_email" class="form-label">電子郵件</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="login_email" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="login_password" class="form-label">密碼</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="login_password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">記住我</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">登入</button>
                                </div>
                            </form>
                        </div>

                        <!-- 註冊表單 -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form method="POST" action="{{ route('register.submit') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="register_name" class="form-label">姓名</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="register_name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="register_email" class="form-label">電子郵件</label>
                                    <input type="email" class="form-control @error('register_email') is-invalid @enderror" 
                                           id="register_email" name="email" value="{{ old('register_email') }}" required>
                                    @error('register_email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="register_password" class="form-label">密碼</label>
                                    <input type="password" class="form-control @error('register_password') is-invalid @enderror" 
                                           id="register_password" name="password" required>
                                    @error('register_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="register_password_confirmation" class="form-label">確認密碼</label>
                                    <input type="password" class="form-control" 
                                           id="register_password_confirmation" name="password_confirmation" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">註冊</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .nav-tabs .nav-link {
        color: #495057;
        border: none;
        padding: 1rem 2rem;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
        background: none;
    }
    
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #0d6efd;
    }
    
    .card-header {
        background: none;
        border-bottom: none;
        padding: 0;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
</style>
@endpush
@endsection 