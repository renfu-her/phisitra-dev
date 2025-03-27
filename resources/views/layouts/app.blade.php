<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $setting->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $setting->meta_keywords ?? '' }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($setting->favicon ?? 'favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- 自定義樣式 -->
    <style>
        body {
            font-family: 'Noto Sans TC', sans-serif;
        }

        .header-top {
            background: #f8f9fa;
            padding: 10px 0;
        }

        .header-info {
            color: #666;
        }

        .header-info i {
            margin-right: 5px;
            color: #007bff;
        }

        .header-logo-menu {
            padding: 15px 0;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .logo img {
            max-height: 60px;
        }

        .mainmenu-area {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .mainmenu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .mainmenu ul li {
            margin: 0 15px;
        }

        .mainmenu ul li a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .mainmenu ul li a:hover {
            color: #007bff;
        }

        .mainmenu .dropdown {
            position: relative;
        }

        .mainmenu .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        .mainmenu .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 160px;
            padding: 0.5rem 0;
            margin: 0;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }

        .mainmenu .dropdown:hover .dropdown-menu {
            display: block;
        }

        .mainmenu .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #333;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .mainmenu .dropdown-item:hover,
        .mainmenu .dropdown-item:focus {
            color: #007bff;
            background-color: #f8f9fa;
        }

        .footer-area {
            background: #333;
            color: #fff;
            padding: 60px 0 30px;
        }

        .footer-widget h4 {
            color: #fff;
            margin-bottom: 20px;
        }

        .footer-widget ul {
            list-style: none;
            padding: 0;
        }

        .footer-widget ul li a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-widget ul li a:hover {
            color: #fff;
        }

        .footer-bottom {
            padding-top: 20px;
            margin-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- 頂部資訊區 -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-end">
                    @if(session('user'))
                        <div class="d-inline-block">
                            <span class="me-3">{{ session('user.name') }}</span>
                            <a href="javascript:void(0)" onclick="logout()" class="btn btn-outline-secondary btn-sm">登出</a>
                        </div>
                    @else
                        <a href="javascript:void(0)" onclick="showLoginModal()" class="btn btn-outline-primary btn-sm">登入</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 登入 Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">登入</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">電子郵件</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="login()">登入</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo 和主選單 -->
    <div class="header-logo-menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-12">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ Storage::url($setting->logo ?? 'images/logo.png') }}" alt="{{ config('app.name') }}">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 d-none d-lg-block">
                    <div class="mainmenu-area">
                        <nav class="mainmenu">
                            <ul>
                                <li><a href="{{ route('home') }}">首頁</a></li>
                                <li><a href="{{ route('about') }}">關於我們</a></li>
                                <li><a href="{{ route('services') }}">服務項目</a></li>
                                <li class="dropdown">
                                    <a href="{{ route('schools') }}" class="dropdown-toggle" data-bs-toggle="dropdown">合作學校</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('schools') }}">學校列表</a></li>
                                        <li><a class="dropdown-item" href="{{ route('students.index') }}">學生資料</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('contact.index') }}">聯絡我們</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 主要內容 -->
    <main>
        @yield('content')
    </main>

    <!-- 頁尾 -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <h4>快速連結</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">首頁</a></li>
                            <li><a href="{{ route('about') }}">關於我們</a></li>
                            <li><a href="{{ route('services') }}">服務項目</a></li>
                            <li><a href="{{ route('contact.index') }}">聯絡我們</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <h4>聯絡資訊</h4>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> {{ $contact->address ?? '' }}</li>
                            <li><i class="fas fa-phone"></i> {{ $contact->phone ?? '' }}</li>
                            <li><i class="fas fa-fax"></i> {{ $contact->fax ?? '' }}</li>
                            <li><i class="fas fa-envelope"></i> {{ $contact->email ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row footer-bottom">
                <div class="col-md-12 text-center">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
    // 全局變量
    let loginModal;

    // 全局函數
    window.showLoginModal = function() {
        loginModal.show();
    };

    window.login = function() {
        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: '/api/auth/login',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ email, password }),
            contentType: 'application/json',
            success: function(data) {
                if (data.success) {
                    loginModal.hide();
                    window.location.reload();
                } else {
                    alert(data.message || '登入失敗');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('登入失敗');
            }
        });
    };

    window.logout = function() {
        if (!confirm('確定要登出嗎？')) return;

        $.ajax({
            url: '/api/auth/logout',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || '登出失敗');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('登出失敗');
            }
        });
    };

    // 當文檔準備就緒時執行
    $(document).ready(function() {
        // 初始化登入 Modal
        loginModal = new bootstrap.Modal($('#loginModal'));

        // 綁定登入表單提交事件
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            login();
        });
    });
    </script>

    @stack('scripts')
</body>
</html> 