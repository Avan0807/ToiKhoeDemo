@extends('frontend.layouts.master')
@section('title', 'Đặt lịch hẹn bác sĩ')

@section('main-content')
    <div class="container">

        <!-- Phần "Khám từ xa qua video call" -->
        <div class="video-call-guide py-5">
            <h2 class="text-primary mb-4 text-center">Khám từ xa qua video call</h2>
            <p class="text-muted mb-5 text-center">Không chỉ tiện lợi, còn rất kỹ lưỡng</p>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="guide-step h-100 rounded bg-white p-3 shadow-sm">
                        <div class="step-header d-flex align-items-center mb-3">
                            <div class="step-number bg-primary rounded-circle me-3 text-center text-white">01</div>
                            <h5 class="mb-0">Chọn bác sĩ từ danh mục</h5>
                        </div>
                        <p>Chọn một bác sĩ từ 41 chuyên khoa và đặt hẹn tư vấn trong 15 - 60 phút tùy nhu cầu.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step h-100 rounded bg-white p-3 shadow-sm">
                        <div class="step-header d-flex align-items-center mb-3">
                            <div class="step-number bg-warning rounded-circle me-3 text-center text-white">02</div>
                            <h5 class="mb-0">Trước hẹn</h5>
                        </div>
                        <p>Tải các kết quả xét nghiệm, hình ảnh, toa thuốc đã dùng và quay video trình bày tình trạng sức
                            khỏe.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step h-100 rounded bg-white p-3 shadow-sm">
                        <div class="step-header d-flex align-items-center mb-3">
                            <div class="step-number bg-success rounded-circle me-3 text-center text-white">03</div>
                            <h5 class="mb-0">Đúng hẹn</h5>
                        </div>
                        <p>Gọi thoại hoặc gọi video để tham vấn trực tiếp với bác sĩ.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step h-100 rounded bg-white p-3 shadow-sm">
                        <div class="step-header d-flex align-items-center mb-3">
                            <div class="step-number bg-info rounded-circle me-3 text-center text-white">04</div>
                            <h5 class="mb-0">Sau hẹn</h5>
                        </div>
                        <p>Nhận chẩn đoán, toa thuốc và được gửi thêm câu hỏi trong vòng 24 giờ sau tư vấn.</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="my-4 text-center">Danh sách bác sĩ</h2>
        <p class="text-muted mb-5 text-center">Khám bệnh từ xa, ngồi nhà hỏi đáp cùng chuyên gia y tế</p>

        <!-- Danh sách bác sĩ -->
        <div class="row g-4">
            @foreach ($doctors as $doctor)
                <div class="col-md-6 col-lg-4">
                    <div class="card doctor-card h-100 shadow">
                        <img src="{{ $doctor->photo ?? asset('default-avatar.png') }}"
                            class="card-img-top doctor-avatar rounded-circle mx-auto mt-3" alt="{{ $doctor->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $doctor->name }}</h5>
                            <p class="text-success"><i class="fa fa-circle"></i>
                                {{ $doctor->status === 'active' ? 'Trực tuyến' : 'Ngoại tuyến' }}</p>
                            <p><i class="fa fa-user-md"></i> Chuyên khoa: <strong>{{ $doctor->specialty }}</strong></p>
                            <p><i class="fa fa-map-marker-alt"></i> Nơi công tác:
                                {{ $doctor->workplace ?? 'Đang cập nhật' }}</p>
                            <div class="doctor-info">
                                <p><i class="fa fa-star text-warning"></i> Đánh giá: 100%</p>
                                <p><i class="fa fa-user"></i> Lượt tư vấn: 100</p>
                                <p><i class="fa fa-briefcase"></i> Kinh nghiệm: {{ $doctor->experience ?? '0' }} năm</p>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-primary btn-book-appointment"
                                data-bs-toggle="modal"
                                data-bs-target="#appointmentModal"
                                data-doctor-name="{{ $doctor->name }}"
                                data-doctor-id="{{ $doctor->doctorID }}">
                                Đặt lịch hẹn
                            </button>

                        </div>
                        <button type="button" class="btn btn-primary btn-doctor-detail"><a
                                href="{{ route('doctor-details', ['doctorID' => $doctor->doctorID]) }}"
                                class="btn btn-primary">Xem chi tiết</a>
                        </button>
                    </div>
                    <!-- Danh sách bác sĩ -->
                    <div class="row g-4">
                        @foreach ($doctors as $doctor)
                            <div class="col-md-6 col-lg-4">
                                <div class="card doctor-card h-100 shadow">
                                    <img src="{{ $doctor->profile_picture ?? asset('default-avatar.png') }}"
                                        class="card-img-top doctor-avatar rounded-circle mx-auto mt-3"
                                        alt="{{ $doctor->name }}">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $doctor->name }}</h5>
                                        <p class="text-success"><i class="fa fa-circle"></i>
                                            {{ $doctor->status === 'active' ? 'Trực tuyến' : 'Ngoại tuyến' }}</p>
                                        <p><i class="fa fa-user-md"></i> Chuyên khoa:
                                            <strong>{{ $doctor->specialty }}</strong></p>
                                        <p><i class="fa fa-map-marker-alt"></i> Nơi công tác:
                                            {{ $doctor->workplace ?? 'Đang cập nhật' }}</p>
                                        <div class="doctor-info">
                                            <p><i class="fa fa-star text-warning"></i> Đánh giá: 100%</p>
                                            <p><i class="fa fa-user"></i> Lượt tư vấn: 100</p>
                                            <p><i class="fa fa-briefcase"></i> Kinh nghiệm:
                                                {{ $doctor->experience ?? '0' }} năm</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('doctor.detail', $doctor->doctorID) }}" class="btn btn-primary">
                                            Xem chi tiết
                                        </a>
                                    </div>
                        @endforeach
                    </div>

                </div>

                <!-- Những câu hỏi thường gặp -->
                <div class="faq-section mt-5">
                    <h3 class="mb-3">Những câu hỏi thường gặp</h3>
                    <ul class="faq-list bg-light rounded p-3">
                        <li><i class="fa fa-question-circle"></i> Các thông tin bệnh nhân mà tôi đưa lên hệ thống có bị các
                            bác sĩ khác thấy hay có nguy cơ lộ thông tin không?</li>
                        <li><i class="fa fa-question-circle"></i> Hướng dẫn bác sĩ chỉ định lấy mẫu tại nhà cho bệnh nhân
                        </li>
                        <li><i class="fa fa-question-circle"></i> Hướng dẫn bác sĩ chia sẻ mã khuyến mãi cho khách hàng</li>
                        <li><i class="fa fa-question-circle"></i> Hướng dẫn bác sĩ xem hồ sơ sức khỏe của bệnh nhân</li>
                        <li><i class="fa fa-question-circle"></i> Tạo lịch khám hoặc gửi lời nhắc cho bệnh nhân</li>
                    </ul>
                </div>

                <!-- Ngàn lời cảm ơn -->
                <div class="thank-you-section mt-5">
                    <h3 class="mb-3">Ngàn lời cảm ơn</h3>
                    <p class="subtitle text-muted">Niềm tự hào của bác sĩ</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="thank-card bg-light rounded p-3 shadow-sm">
                                <p><i class="fa fa-quote-left text-primary"></i> Rất tuyệt vời, đặc biệt trong mùa dịch đi
                                    lại khó khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn.</p>
                                <p class="text-end"><strong>- Duy Nguyễn Nhật</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="thank-card bg-light rounded p-3 shadow-sm">
                                <p><i class="fa fa-quote-left text-primary"></i> Ứng dụng rất hay. Giúp mọi người hạn chế
                                    bệnh gì cũng phải đến bệnh viện khám. Đỡ mất thời gian, công sức và tiền bạc.</p>
                                <p class="text-end"><strong>- Hoàng Minh Tâm</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    @endsection

    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/css/doctorlist.css') }}">
    @endpush


    @push('scripts')
        <script></script>
    @endpush
