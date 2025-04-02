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
                <div class="card student-card {{ isset($student['student_member']) ? 'selected' : '' }}">
                    <div class="card-img-wrapper position-relative">
                        <img src="{{ $student['photo'] }}" 
                             class="card-img-top student-photo" 
                             alt="{{ $student['name_zh'] }}"
                             onerror="this.src='/images/default-student.jpg'">
                        @if(isset($student['student_member']))
                            <div class="selected-mark">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="status-toggle">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" 
                                           id="status-{{ $student['id'] }}"
                                           {{ $student['student_member']['status'] ? 'checked' : '' }}
                                           onchange="toggleStatus({{ $student['id'] }}, this.checked)">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title student-name">{{ $student['name_zh'] }}</h5>
                        <p class="card-text student-name-en">{{ $student['name_en'] }}</p>
                        @if(isset($student['gender']))
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-venus-mars"></i> 
                                    {{ $student['gender'] === 'male' ? '男生' : '女生' }}
                                </small>
                            </p>
                        @endif
                    </div>
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
        position: relative;
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
    .card-img-wrapper {
        position: relative;
    }
    .selected-mark {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #28a745;
        font-size: 24px;
        z-index: 2;
    }
    .status-toggle {
        position: absolute;
        bottom: 10px;
        right: 10px;
        z-index: 2;
    }
    .form-switch .form-check-input {
        width: 40px;
        height: 20px;
        cursor: pointer;
    }
    .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }
    .selected {
        border: 2px solid #28a745;
    }
</style>
@endpush

@push('scripts')
<script>
function toggleStatus(studentId, status) {
    fetch(`/students/${studentId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 可以添加成功提示
            console.log('狀態更新成功');
        } else {
            // 如果更新失敗，恢復開關狀態
            document.getElementById(`status-${studentId}`).checked = !status;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // 發生錯誤時恢復開關狀態
        document.getElementById(`status-${studentId}`).checked = !status;
    });
}
</script>
@endpush
@endsection 