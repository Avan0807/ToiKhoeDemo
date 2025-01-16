@extends('frontend.layouts.master')
@section('title', 'Chi Tiết Bác Sĩ')
@section('content')
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

                    <h4 class="text-primary pb-3">Giới Thiệu</h4>
                    <p>
                        {{ $doctor->description ?? 'Thông tin về bác sĩ hiện chưa được cập nhật.' }}
                    </p>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary me-2">Liên Hệ</button>
                        <button class="btn btn-success me-2">Đặt Lịch Khám</button>
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
                            <ul>
                                <li>1984 - 1990: sinh viên trường Đại học Y Hà Nội</li>
                                <li>
                                    1990 - 1993: Bác sĩ nội trú Tai mũi họng tại bộ môn Tai mũi họng trường Đại học Y Hà Nội
                                </li>
                                <li>
                                    1995 - 1996: đào tạo theo chương trình bác sĩ nội trú Tai Mũi Họng tại Trung tâm viện
                                    trường Đại học Lille - Cộng hòa Pháp.
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 border-start ps-4">
                            <h5>Kỹ Năng Chuyên Môn</h5>
                            <ul>
                                <li>
                                    Chuyên sâu về các bệnh lý mũi xoang, phẫu thuật nội soi mũi xoang và nền sọ
                                </li>
                                <li>
                                    Chuyên sâu về các bệnh lý Tai, Tai thần kinh và phẫu thuật Tai
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
