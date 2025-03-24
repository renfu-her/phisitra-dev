@extends('layouts.app')

@section('title', $about['seo_title'] ?? '關於我們')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="mb-4">{{ $about['title'] }}</h1>
            <p class="lead">{{ $about['subtitle'] }}</p>
            <div class="content">
                {!! $about['content'] !!}
            </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('storage/' . $about['image']) }}" alt="{{ $about['title'] }}" class="img-fluid rounded shadow">
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">我們的使命</h2>
            <div class="card">
                <div class="card-body">
                    <p class="text-center">{{ $about['mission'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="text-center">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h3>專業團隊</h3>
                <p>{{ $about['team_description'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                <h3>優質教育</h3>
                <p>{{ $about['education_description'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
                <h3>國際合作</h3>
                <p>{{ $about['cooperation_description'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection 