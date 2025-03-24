@extends('layouts.app')

@section('title', '關於我們 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    @if($about['status'] ?? false)
        <h1 class="text-center mb-5">{{ $about['data']['title'] }}</h1>

        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <img src="{{ asset('storage/' . $about['data']['image']) }}" alt="{{ $about['data']['title'] }}" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">{{ $about['data']['subtitle'] }}</h2>
                <div class="content">
                    {!! $about['data']['content'] !!}
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <h2 class="text-center mb-4">我們的使命</h2>
                <p class="text-center lead">{{ $about['data']['mission'] }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">專業團隊</h3>
                        <p class="card-text">{{ $about['data']['team_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">教育理念</h3>
                        <p class="card-text">{{ $about['data']['education_description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">合作關係</h3>
                        <p class="card-text">{{ $about['data']['cooperation_description'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-4">關於我們</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>
@endsection 