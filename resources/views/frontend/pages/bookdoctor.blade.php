@extends('frontend.layouts.master')
@section('title', 'Đặt lịch hẹn bác sĩ')

@section('main-content')
<div class="container">
    <h1 class="text-center">Danh sách bác sĩ</h1>
    <h2 class="text-center">Khám bệnh từ xa, ngồi nhà hỏi đáp cùng chuyên gia y tế</h2>
    <div class="row">
        @foreach($doctors as $doctor)
        <div class="col-md-4">
            <div class="card doctor-card">
                <img src="{{ $doctor->profile_picture ?? 'default-avatar.png' }}" class="card-img-top doctor-avatar" alt="{{ $doctor->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $doctor->name }}</h5>
                    <p class="text-success"><i class="fa fa-circle"></i> {{ $doctor->status === 'active' ? 'Trực tuyến' : 'Ngoại tuyến' }}</p>
                    <p>Chuyên khoa: {{ $doctor->specialty }}</p>
                    <p><i class="fa fa-map-marker-alt"></i> Nơi công tác: {{ $doctor->workplace ?? 'Đang cập nhật' }}</p>
                    <div class="doctor-info">
                        <p><i class="fa fa-star"></i> Đánh giá: 100%</p>
                        <p><i class="fa fa-user"></i> Lượt tư vấn: 100</p>
                        <p><i class="fa fa-briefcase"></i> Kinh nghiệm: {{ $doctor->experience ?? '0' }} năm</p>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">Đặt lịch hẹn</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
    <style>
        .doctor-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .doctor-avatar {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .text-success {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .doctor-info p {
            font-size: 14px;
            margin: 5px 0;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
        }
    </style>
@endpush


