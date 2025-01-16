@extends('frontend.layouts.master')
@section('title', "Bác sĩ $doctor->name")

@section('main-content')
<div class="container">
    

    <h2 class="text-primary">{{ $doctor->name }} <span class="badge bg-info">Chính thức</span></h2>
    <p class="text-muted">TDOCOTOR: {{ $doctor->doctorID }}</p>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ $doctor->profile_picture ?? asset('default-avatar.png') }}" class="img-fluid rounded" alt="{{ $doctor->name }}">
        </div>
        <div class="col-md-8">
            <h4>Chuyên khoa</h4>
            <p>{{ $doctor->specialty }}</p>

            <h4>Dịch vụ</h4>
            <p>{{ $doctor->services ?? 'Đang cập nhật' }}</p>

            <h4>Nơi công tác</h4>
            <p>{{ $doctor->workplace ?? 'Đang cập nhật' }}</p>

            <h4>Kinh nghiệm</h4>
            <p>{{ $doctor->experience ?? '0' }} năm</p>

            <h4>Quá trình đào tạo</h4>
            <p>{{ $doctor->education ?? 'Đang cập nhật' }}</p>

            <h4>Giá tư vấn</h4>
            <p>{{ number_format($doctor->price_per_minute, 0, ',', '.') }} VND/Phút</p>

            <a href="{{ route('appointment.form', $doctor->id) }}" class="btn btn-success mt-3">Đặt lịch hẹn</a>

        </div>
    </div>
</div>
@endsection
