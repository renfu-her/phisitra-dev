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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                <div class="col-lg-7 col-md-8">
                    <div class="header-info">
                        <span><i class="far fa-clock"></i>營業時間：週一至週五 9:00-18:00</span>
                        <span class="ms-3"><i class="fas fa-phone"></i>{{ $setting->phone ?? '' }}</span>
                        <span class="ms-3"><i class="fas fa-envelope"></i>{{ $setting->email ?? '' }}</span>
                    </div>
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
                            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
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
                                <li><a href="{{ route('schools') }}">合作學校</a></li>
                                <li><a href="{{ route('contact') }}">聯絡我們</a></li>
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
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>關於我們</h4>
                        <p>{{ $setting->description ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h4>快速連結</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">首頁</a></li>
                            <li><a href="{{ route('about') }}">關於我們</a></li>
                            <li><a href="{{ route('services') }}">服務項目</a></li>
                            <li><a href="{{ route('contact') }}">聯絡我們</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>聯絡資訊</h4>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> {{ $setting->address ?? '' }}</li>
                            <li><i class="fas fa-phone"></i> {{ $setting->phone ?? '' }}</li>
                            <li><i class="fas fa-envelope"></i> {{ $setting->email ?? '' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>追蹤我們</h4>
                        <div class="social-links">
                            @if($setting->facebook ?? '')
                                <a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a>
                            @endif
                            @if($setting->instagram ?? '')
                                <a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($setting->line ?? '')
                                <a href="{{ $setting->line }}" target="_blank"><i class="fab fa-line"></i></a>
                            @endif
                        </div>
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
    
    @stack('scripts')
</body>
</html> 