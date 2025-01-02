@extends('frontend.layouts.master')
@section('title','Booking Doctor')

@section('main-content')

    <div class="doctor-list-container">
        <!-- Sidebar -->
        <div class="single-widget category">
        <h3 class="title">Danh sách bác sĩ</h3>
        <ul class="doctor-list">

            @if($doctors)
                @foreach($doctors as $doctor)
                    <li>
                        <a href="#">{{ $doctor->name }} - {{ $doctor->specialization->name ?? 'Chưa có chuyên môn' }}</a>
                        <ul>
                            <li>Điện thoại: {{ $doctor->phone }}</li>
                            <li>Email: {{ $doctor->email }}</li>
                            <li>Địa chỉ: {{ $doctor->location }}</li>
                            @if($doctor->status)
                                <li>Trạng thái: {{ $doctor->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</li>
                            @endif
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <h3>Danh sách bác sĩ</h3>
        <div class="doctor-card">
            <img src="doctor-placeholder.jpg" alt="Doctor Avatar" class="doctor-avatar">
            <div class="doctor-info">
                <h4>Bác sĩ Lê Công Định</h4>
                <p>Chuyên khoa: Tai - Mũi - Họng</p>
                <p>Bệnh viện công tác: Bệnh viện Bạch Mai</p>
                <p class="rating">⭐ 4.2 (78 reviews)</p>
            </div>
            <div class="doctor-actions">
                <button class="btn-view-profile">Xem hồ sơ</button>
                <button class="btn-book-appointment">Đặt lịch khám</button>
            </div>
        </div>
        <div class="doctor-card">
            <img src="doctor-placeholder.jpg" alt="Doctor Avatar" class="doctor-avatar">
            <div class="doctor-info">
                <h4>Bác sĩ Lê Công Định</h4>
                <p>Chuyên khoa: Tai - Mũi - Họng</p>
                <p>Bệnh viện công tác: Bệnh viện Bạch Mai</p>
                <p class="rating">⭐ 4.2 (78 reviews)</p>
            </div>
            <div class="doctor-actions">
                <button class="btn-view-profile">Xem hồ sơ</button>
                <button class="btn-book-appointment">Đặt lịch khám</button>
            </div>
        </div>
        <div class="doctor-card">
            <img src="doctor-placeholder.jpg" alt="Doctor Avatar" class="doctor-avatar">
            <div class="doctor-info">
                <h4>Bác sĩ Lê Công Định</h4>
                <p>Chuyên khoa: Tai - Mũi - Họng</p>
                <p>Bệnh viện công tác: Bệnh viện Bạch Mai</p>
                <p class="rating">⭐ 4.2 (78 reviews)</p>
            </div>
            <div class="doctor-actions">
                <button class="btn-view-profile">Xem hồ sơ</button>
                <button class="btn-book-appointment">Đặt lịch khám</button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <span class="page-number active">1</span>
            <span class="page-number">2</span>
            <span class="page-number">3</span>
        </div>
    </div>
</div>
@endsection
