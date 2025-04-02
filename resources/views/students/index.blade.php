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
                        <div class="card-img-wrapper position-relative">
                            <img src="{{ asset('storage/' . $student->photo) }}" class="card-img-top student-photo"
                                alt="{{ $student->name_zh }}">
                            <div class="status-toggle">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="select-{{ $student->id }}"
                                        {{ $student->studentMember ? 'checked' : '' }}
                                        onchange="toggleStudentMember({{ $student->id }}, this.checked)">
                                    <label class="form-check-label" for="select-{{ $student->id }}">
                                        {{ $student->studentMember ? '已選擇' : '未選擇' }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title student-name">{{ $student->name_zh }}</h5>
                            <p class="card-text student-name-en">{{ $student->name_en }}</p>
                            @if ($student->gender)
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-venus-mars"></i>
                                        {{ $student->gender === 'male' ? '男生' : '女生' }}
                                    </small>
                                </p>
                            @endif
                            @if ($student->school_name)
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-school"></i>
                                        {{ $student->school_name }}
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

        @if (isset($pagination))
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            @if ($pagination['current_page'] > 1)
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $pagination['current_page'] - 1 }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $pagination['last_page']; $i++)
                                <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($pagination['current_page'] < $pagination['last_page'])
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $pagination['current_page'] + 1 }}"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @endif
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
                margin-bottom: 0.5rem;
            }

            .card-text {
                margin-bottom: 0.3rem;
            }

            .card-text .fas {
                width: 20px;
                text-align: center;
                margin-right: 5px;
            }

            .status-toggle {
                position: absolute;
                bottom: 10px;
                right: 10px;
                background: rgba(255, 255, 255, 0.9);
                padding: 5px 10px;
                border-radius: 20px;
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

            .form-check-label {
                font-size: 0.8rem;
                color: #666;
                margin-left: 5px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function toggleStudentMember(studentId, checked) {
                const url = checked ? `/students/${studentId}/attach` : `/students/${studentId}/detach`;
                const label = document.querySelector(`label[for="select-${studentId}"]`);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            label.textContent = checked ? '已選擇' : '未選擇';
                        } else {
                            // 如果操作失敗，恢復開關狀態
                            document.getElementById(`select-${studentId}`).checked = !checked;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // 發生錯誤時恢復開關狀態
                        document.getElementById(`select-${studentId}`).checked = !checked;
                    });
            }
        </script>
    @endpush
@endsection
