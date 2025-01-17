@extends('frontend.layouts.master')
@section('title', "Đặt lịch với $doctor->name")

@section('main-content')
<form action="{{ route('appointment.store') }}" method="POST">
    @csrf
    <input type="hidden" name="doctorID" value="{{ $doctor->doctorID }}">

    <div class="mb-3">
        <label class="form-label">Ngày khám</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Giờ khám</label>
        <input type="time" name="time" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình thức tư vấn</label>
        <select name="consultation_type" class="form-control" required>
            <option value="Online">Online</option>
            <option value="Offline">Offline</option>
            <option value="Home">Home</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Ghi chú</label>
        <textarea name="note" class="form-control"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">Xác Nhận Đặt Lịch</button>
    </div>
</form>

@endsection
