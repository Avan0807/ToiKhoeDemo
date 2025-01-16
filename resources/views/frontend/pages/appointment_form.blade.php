@extends('frontend.layouts.master')
@section('title', "Đặt lịch với $doctor->name")

@section('main-content')
<div class="container">
    <h2 class="text-center">Đặt lịch với bác sĩ {{ $doctor->name }}</h2>

    <form action="{{ route('appointment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="doctorID" value="{{ $doctor->doctorID }}">

        <div class="mb-3">
            <label for="date" class="form-label">Chọn ngày</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Chọn giờ</label>
            <input type="time" class="form-control" name="time" required>
        </div>

        <div class="mb-3">
            <label for="consultation_type" class="form-label">Loại tư vấn</label>
            <select class="form-select" name="consultation_type" required>
                <option value="Online">Online</option>
                <option value="Offline">Offline</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú</label>
            <textarea class="form-control" name="note" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Xác nhận đặt lịch</button>
    </form>
</div>
@endsection
