<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    /**
     * Xử lý đặt lịch hẹn và lưu vào bảng appointments
     */
    public function store(Request $request)
    {

        // Kiểm tra nếu bác sĩ tồn tại trong bảng Doctors
        $doctor = Doctor::find($request->doctorID);
        if (!$doctor) {
            return response()->json(['error' => 'Bác sĩ không tồn tại'], 404);
        }

        try {
            $request->validate([
                'doctorID' => 'required|exists:doctors,id',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required',
                'consultation_type' => 'required|in:Online,Offline',
                'note' => 'nullable|string|max:255',
            ]);
    
            // Tạo mới lịch hẹn
            $appointment = Appointment::create([
                'userID' => Auth::id(),
                'doctorID' => $request->doctorID,
                'date' => $request->date,
                'time' => $request->time,
                'consultation_type' => $request->consultation_type,
                'note' => $request->note,
                'status' => 'Chờ duyệt',
                'approval_status' => 'Chờ duyệt',
                'workflow_stage' => 'initial_review',
            ]);
    
            return response()->json([
                'success' => 'Đặt lịch hẹn thành công!',
                'appointment' => $appointment,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error booking appointment: ' . $e->getMessage());  // Ghi lại lỗi chi tiết
            return response()->json([
                'error' => 'Đã xảy ra lỗi trong quá trình đặt lịch.',
            ], 500);
        }
    }
    
    public function create($id)
    {
        $doctor = Doctor::where('doctorID', $id)->firstOrFail();
        return view('frontend.pages.appointment_form', compact('doctor'));
    }
    
}
