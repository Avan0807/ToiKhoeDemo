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
                </div>
            @endforeach
        </div>

        <!-- Modal Đặt lịch hẹn -->
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="appointmentForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="appointmentModalLabel">Đặt lịch hẹn với <span
                                    id="doctorName"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="doctorID" id="doctorID">
                            <div class="mb-3">
                                <label for="date" class="form-label">Chọn ngày</label>
                                <input type="date" class="form-control" name="date" id="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Chọn giờ</label>
                                <input type="time" class="form-control" name="time" id="time" required>
                            </div>
                            <div class="mb-3">
                                <label for="consultation_type" class="form-label">Loại tư vấn</label>
                                <select class="form-select" name="consultation_type" id="consultation_type" required>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Đặt lịch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

    <!-- Những câu hỏi thường gặp -->
    <div class="faq-section mt-5">
        <h3 class="mb-3">Những câu hỏi thường gặp</h3>
        <ul class="faq-list bg-light rounded p-3">
            <li><i class="fa fa-question-circle"></i> Các thông tin bệnh nhân mà tôi đưa lên hệ thống có bị các bác sĩ khác
                thấy hay có nguy cơ lộ thông tin không?</li>
            <li><i class="fa fa-question-circle"></i> Hướng dẫn bác sĩ chỉ định lấy mẫu tại nhà cho bệnh nhân</li>
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
                    <p><i class="fa fa-quote-left text-primary"></i> Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó
                        khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn.</p>
                    <p class="text-end"><strong>- Duy Nguyễn Nhật</strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="thank-card bg-light rounded p-3 shadow-sm">
                    <p><i class="fa fa-quote-left text-primary"></i> Ứng dụng rất hay. Giúp mọi người hạn chế bệnh gì cũng
                        phải đến bệnh viện khám. Đỡ mất thời gian, công sức và tiền bạc.</p>
                    <p class="text-end"><strong>- Hoàng Minh Tâm</strong></p>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Card Styles */
        .doctor-card {
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .doctor-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .doctor-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 3px solid #007bff;
            margin-top: -60px;
            background-color: #fff;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Button Styles */
        .btn-primary,
        .btn-secondary {
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            padding: 15px 30px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #ddd;
        }

        .modal-footer .btn:hover {
            transform: scale(1.1);
        }

        /* FAQ Styles */
        .faq-list li {
            list-style: none;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .faq-list li i {
            color: #007bff;
            margin-right: 8px;
        }

        /* Thank You Section */
        .thank-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .thank-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Video Call Guide */
        .video-call-guide {
            background-color: #f8f9fa;
            padding: 40px 20px;
            border-radius: 12px;
        }

        .guide-step {
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .guide-step:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .step-header {
            display: flex;
            align-items: center;
        }

        .step-number {
            width: 50px;
            height: 50px;
            line-height: 50px;
            font-size: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .step-number.bg-primary {
            background-color: #007bff;
        }

        .step-number.bg-warning {
            background-color: #ffc107;
        }

        .step-number.bg-success {
            background-color: #28a745;
        }

        .step-number.bg-info {
            background-color: #17a2b8;
        }

        .step-number.bg-primary:hover,
        .step-number.bg-warning:hover,
        .step-number.bg-success:hover,
        .step-number.bg-info:hover {
            background-color: darken(#007bff, 10%);
        }

        .row {
            row-gap: 20px;
        }

        .col-md-4 {
            padding: 10px;
        }

        .card {
            margin: 10px 0;
        }

        /* Modal Styles */
        .modal-dialog {
            max-width: 700px;
            margin: 50px auto;
        }

        .modal-body input,
        .modal-body select,
        .modal-body textarea {
            font-size: 16px;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal-body .form-label {
            font-size: 16px;
            font-weight: bold;
        }

        .modal-header .modal-title {
            font-size: 20px;
            font-weight: bold;
        }

        .modal-header {
            padding-bottom: 20px;
        }

        .modal-body .mb-3:first-child {
            margin-top: 30px;
        }

        /* Footer */
        footer {
            margin-top: 20px;
            padding-bottom: 30px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentModal = document.getElementById('appointmentModal');
            const doctorNameField = document.getElementById('doctorName');
            const doctorIDField = document.getElementById('doctorID');
            const appointmentForm = document.getElementById('appointmentForm');

            // Khi nhấn "Đặt lịch hẹn", modal mở và bác sĩ được chọn
            document.querySelectorAll('.btn-book-appointment').forEach(button => {
                button.addEventListener('click', function() {
                    const doctorName = this.getAttribute('data-doctor-name');
                    const doctorID = this.getAttribute('data-doctor-id');

                    doctorNameField.textContent = doctorName;
                    doctorIDField.value = doctorID;

                    // Mở modal
                    const bootstrapModal = new bootstrap.Modal(appointmentModal);
                    bootstrapModal.show();
                });
            });

            // Xử lý form đặt lịch
            appointmentForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Ngừng hành động mặc định của form

                const formData = new FormData(appointmentForm);

                // Gửi yêu cầu POST tới API để đặt lịch
                fetch("{{ route('appointment.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: formData,
                    })
                    .then(response => response.json()) // Chuyển phản hồi thành JSON
                    .then(data => {
                        if (data.success) {
                            alert(data.success); // Thông báo thành công
                            $('#appointmentModal').modal('hide'); // Đóng modal
                            appointmentForm.reset(); // Reset form
                        } else {
                            alert(data.error ||
                                'Đã xảy ra lỗi, vui lòng thử lại.'); // Hiển thị lỗi từ server
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error); // Xử lý lỗi khi gửi yêu cầu
                        alert('Đã xảy ra lỗi trong quá trình gửi yêu cầu, vui lòng thử lại.');
                    });
            });
        });
    </script>
@endpush
