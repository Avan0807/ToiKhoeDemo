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
                        <button class="btn btn-success me-2" id="openBookingModal"
                            data-doctor-id="{{ $doctor->doctorID }}"
                            data-doctor-name="{{ $doctor->name }}">
                            Đặt Lịch Khám
                        </button>
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

        <!-- Modal Đặt Lịch Khám -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Đặt lịch hẹn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="bookingForm">
                            <!-- Đảm bảo doctorID được lấy ngay khi tải trang -->
                            <input type="hidden" id="doctorID" name="doctorID" value="{{ $doctor->doctorID }}">
                            <input type="hidden" id="userID" value="{{ auth()->id() }}">

                            <div class="mb-3">
                                <label for="doctorName" class="form-label">Bác sĩ</label>
                                <input type="text" class="form-control" id="doctorName" value="{{ $doctor->name }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Ngày khám</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <div class="mb-3">
                                <label for="time" class="form-label">Giờ khám</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>

                            <div class="mb-3">
                                <label for="consultation_type" class="form-label">Hình thức khám</label>
                                <select class="form-control" id="consultation_type" name="consultation_type" required>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" name="note" rows="3">Lịch khám định kỳ</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Xác nhận đặt lịch</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Khi nhấn nút "Đặt lịch hẹn"
            document.getElementById("openBookingModal").addEventListener("click", function() {
                let modal = new bootstrap.Modal(document.getElementById("bookingModal"));
                modal.show();
            });

            // Xử lý sự kiện khi form được submit
            document.getElementById("bookingForm").addEventListener("submit", function(event) {
                event.preventDefault();

                let doctorID = document.getElementById("doctorID").value;
                let userID = document.getElementById("userID").value;
                let date = document.getElementById("date").value;
                let time = document.getElementById("time").value;
                let consultationType = document.getElementById("consultation_type").value;
                let note = document.getElementById("note").value;

                let formData = {
                    doctorID: doctorID,
                    date: date,
                    time: time,
                    consultation_type: consultationType,
                    note: note
                };

                console.log("DEBUG: SENDING DATA:", formData);

                fetch(`/api/appointments/${userID}/create`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("RESPONSE:", data);
                        if (data.success) {
                            alert("Đặt lịch thành công!");
                            window.location.reload();
                        } else {
                            alert("Lỗi: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("LỖI:", error);
                        alert("Không thể đặt lịch, vui lòng thử lại.");
                    });
            });
        });
    </script>
@endpush
