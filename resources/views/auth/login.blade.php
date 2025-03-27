@extends('layouts.app')

@section('title', '登入/註冊 - ' . config('app.name'))

@section('content')
    <div class="auth-container">
        <div class="row g-0">
            <!-- 左側圖片區 -->
            <div class="col-lg-6">
                <img src="{{ asset('images/auth.jpg') }}" alt="Welcome illustration" class="auth-image">
            </div>

            <!-- 右側表單區 -->
            <div class="col-lg-6 col-md-12">
                <div class="auth-form-container">
                    <div class="auth-header">
                        <h2 class="auth-title">歡迎回來</h2>
                        <div class="auth-tabs">
                            <button class="auth-tab-btn active" data-bs-toggle="tab" data-bs-target="#login">登入</button>
                            <button class="auth-tab-btn" data-bs-toggle="tab" data-bs-target="#register">註冊</button>
                        </div>
                    </div>

                    <div class="tab-content auth-forms">
                        <!-- 登入表單 -->
                        <div class="tab-pane fade show active" id="login">
                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.submit') }}" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label for="login_email">電子郵件</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="login_email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="login_password">密碼</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="login_password" name="password" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">記住我</label>
                                    </div>
                                    <a href="#" class="forgot-password">忘記密碼？</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-auth">登入</button>
                            </form>
                        </div>

                        <!-- 註冊表單 -->
                        <div class="tab-pane fade" id="register">
                            <form method="POST" action="{{ route('register.submit') }}" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label for="register_name">姓名</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="register_name" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register_email">電子郵件</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="register_email" name="email" value="{{ old('email') }}"
                                            required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register_password">密碼</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="register_password" name="password" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="register_password_confirmation">確認密碼</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="register_password_confirmation" name="password_confirmation" required>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-auth">註冊</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .auth-container {
                min-height: calc(100vh - 200px);
                background-color: #ffffff;
            }

            .auth-image {
                width: 100%;
                height: 570px;
                object-fit: cover;
            }

            .auth-form-container {
                padding: 3rem;
                max-width: 500px;
                margin: 0 auto;
            }

            .auth-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .auth-title {
                font-size: 2rem;
                font-weight: 600;
                color: #2d3436;
                margin-bottom: 1.5rem;
            }

            .auth-tabs {
                display: flex;
                justify-content: center;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .auth-tab-btn {
                background: none;
                border: none;
                padding: 0.5rem 1.5rem;
                font-size: 1rem;
                color: #636e72;
                position: relative;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .auth-tab-btn::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: transparent;
                transition: all 0.3s ease;
            }

            .auth-tab-btn.active {
                color: #00b894;
            }

            .auth-tab-btn.active::after {
                background-color: #00b894;
            }

            .auth-forms {
                margin-top: 2rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                color: #2d3436;
                font-weight: 500;
            }

            .input-group {
                border: 1px solid #dfe6e9;
                border-radius: 8px;
                overflow: hidden;
            }

            .input-group-text {
                background-color: #f8f9fa;
                border: none;
                color: #636e72;
            }

            .form-control {
                border: none;
                padding: 0.75rem 1rem;
                font-size: 1rem;
            }

            .form-control:focus {
                box-shadow: none;
                border-color: #00b894;
            }

            .btn-auth {
                width: 100%;
                padding: 0.75rem;
                font-size: 1rem;
                background-color: #00b894;
                border: none;
                border-radius: 8px;
                margin-top: 1rem;
                transition: all 0.3s ease;
            }

            .btn-auth:hover {
                background-color: #00a884;
                transform: translateY(-1px);
            }

            .forgot-password {
                color: #00b894;
                text-decoration: none;
                font-size: 0.9rem;
            }

            .forgot-password:hover {
                color: #00a884;
                text-decoration: underline;
            }

            .form-check-label {
                color: #636e72;
                font-size: 0.9rem;
            }

            .alert-danger {
                background-color: #fff3f3;
                border-color: #ffa7a7;
                color: #dc3545;
            }

            .alert-danger ul {
                list-style: none;
                padding-left: 0;
            }

            .invalid-feedback {
                display: block;
                margin-top: 0.5rem;
                font-size: 0.875rem;
                color: #dc3545;
            }

            @media (max-width: 991.98px) {
                .auth-form-container {
                    padding: 2rem 1.5rem;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                // 初始化 Bootstrap Tab
                var tabs = new bootstrap.Tab(document.querySelector('.auth-tab-btn.active'));

                // 切換頁籤時更新按鈕狀態和顯示相應的表單
                $('.auth-tab-btn').on('click', function(e) {
                    e.preventDefault();

                    // 更新按鈕狀態
                    $('.auth-tab-btn').removeClass('active');
                    $(this).addClass('active');

                    // 顯示對應的表單
                    var targetId = $(this).data('bs-target');
                    $('.tab-pane').removeClass('show active');
                    $(targetId).addClass('show active');
                });
            });
        </script>
    @endpush
@endsection
