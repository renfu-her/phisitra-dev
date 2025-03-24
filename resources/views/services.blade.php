@extends('layouts.app')

@section('title', '服務項目 - ' . config('app.name'))

@section('content')
<div class="container py-5">
    @if($services['status'] ?? false)
        <h1 class="text-center mb-5">服務項目</h1>

        <div class="row g-4">
            @foreach($services['data'] as $service)
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="{{ $service['icon'] }} fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">{{ $service['title'] }}</h3>
                        <p class="card-text">{{ $service['description'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <h3>需要更多資訊？</h3>
            <p class="lead">歡迎與我們聯繫，我們將為您提供詳細的服務說明</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">聯絡我們</a>
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-4">服務項目</h1>
            <p class="lead">資料不存在</p>
        </div>
    @endif
</div>
@endsection 