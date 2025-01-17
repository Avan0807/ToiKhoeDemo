@extends('frontend.layouts.master')
@section('title', "Bác sĩ $doctor->name")

@section('main-content')
<div class="container mt-5 border">
        <!-- Doctor Info Section -->
        <div class="row align-items-center">
            <!-- Phần hình ảnh và đánh giá -->
            <div class="col-md-4 pt-3 text-center">
                <img
                    style="height: 250px; width: 250px"
                    src="{{ $doctor->photo ?? 'https://via.placeholder.com/250' }}"
                    class="rounded-circle img-fluid shadow"
                    alt="Doctor Image" />
                <h3 class="mt-3">{{ $doctor->name }}</h3>
                <p class="text-muted">({{ $doctor->specialization }})</p>
                <div class="mt-2">
                    <span class="text-warning fs-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($doctor->rating ?? 4.0))
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </span>
                    <p class="fw-semibold mt-1">{{ $doctor->rating ?? '4.0' }} out of 5</p>
                </div>
            </div>

            <!-- Phần thông tin -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h4 class="text-primary pb-3">Thông Tin Liên Hệ</h4>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Địa chỉ công tác:</strong> {{ $doctor->location ?? 'Không rõ' }}
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i>
                        <strong>Email:</strong> {{ $doctor->email ?? 'Không rõ' }}
                    </p>
                    <p>
                        <i class="fas fa-phone"></i>
                        <strong>Số điện thoại:</strong> {{ $doctor->phone ?? 'Không rõ' }}
                    </p>
                    <p>
                        <i class="fas fa-clock"></i>
                        <strong>Giờ làm việc:</strong> {{ $doctor->working_hours ?? 'Không rõ' }}
                    </p>
                    <p>
                        <i class="fas fa-dollar-sign"></i>
                        <strong>Phí tư vấn:</strong> {{ number_format($doctor->consultation_fee, 2) }} VND
                    </p>

                    <h4 class="text-primary pb-3">Giới Thiệu</h4>
                    <p>
                        {{ $doctor->bio ?? 'Thông tin về bác sĩ hiện chưa được cập nhật.' }}
                    </p>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary me-2">Liên Hệ</button>
                        <a href="{{ route('appointment.form', ['id' => $doctor->doctorID ]) }}" class="btn btn-primary me-2">
                            Đặt Lịch Khám
                        </a>
                        <button class="btn btn-warning">Chat</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Work Experience Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <h4>Kinh Nghiệm Làm Việc</h4>
                    <div class="row">
                        <div class="col-md-6 ps-4">
                            <h5>Kinh Nghiệm</h5>
                            <p>{{ $doctor->experience }} năm kinh nghiệm</p>
                        </div>
                        <div class="col-md-6 border-start ps-4">
                            <h5>Kỹ Năng Chuyên Môn</h5>
                            <p>{{ $doctor->services ?? 'Chưa cập nhật' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <h4>Học Vấn</h4>
                    <p>{{ $doctor->education ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
        </div>

        <!-- Workplace Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <h4>Nơi Công Tác</h4>
                    <p>{{ $doctor->workplace ?? 'Chưa cập nhật' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection