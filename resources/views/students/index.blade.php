@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="section-title-wrapper">
            <div class="section-title">
                <h3>學生專區</h3>
                <p>我們的優秀學生</p>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($students as $student)
            <div class="col-md-3 col-sm-6">
                <div class="card student-card">
                    <a href="{{ route('students.show', $student['id']) }}" class="text-decoration-none">
                        <img src="{{ $student['photo'] }}" 
                             class="card-img-top student-photo" 
                             alt="{{ $student['name_zh'] }}"
                             onerror="this.src='/images/default-student.jpg'">
                        <div class="card-body">
                            <h5 class="card-title student-name">{{ $student['name_zh'] }}</h5>
                            <p class="card-text student-name-en">{{ $student['name_en'] }}</p>
                            @if(isset($student['gender']))
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-venus-mars"></i> {{ $student['gender'] }}
                                    </small>
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    目前沒有任何學生資料。
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    .student-card {
        margin-bottom: 2rem;
        transition: transform 0.2s;
    }
    .student-card:hover {
        transform: translateY(-5px);
    }
    .student-photo {
        height: 250px;
        object-fit: cover;
    }
    .student-name {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .student-name-en {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endpush
@endsection 