<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;

use Illuminate\Support\Facades\Validator;


class AppointmentsController extends Controller
{

    public function createAppointment(Request $request, $userID)
    {
        $validator = Validator::make($request->all(), [
            'doctorID' => 'required|exists:Doctors,DoctorID',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'consultation_type' => 'required|in:Online,Offline',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $appointment = Appointment::create([
                'userID' => $userID,
                'doctorID' => $request->doctorID,
                'date' => $request->date,
                'time' => $request->time,
                'consultation_type' => $request->consultation_type,
                'note' => $request->note,
                'status' => 'Scheduled',
                'approval_status' => 'Pending',
                'workflow_stage' => 'Requested',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Yêu cầu đặt lịch khám đã được gửi.',
                'appointment' => $appointment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi yêu cầu đặt lịch khám.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Lấy danh sách tất cả các cuộc hẹn.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAppointments()
    {
        try {
            // Lấy danh sách tất cả các cuộc hẹn
            $appointments = Appointment::all();

            return response()->json([
                'success' => true,
                'appointments' => $appointments,
            ], 200);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy danh sách cuộc hẹn.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getAppointmentsByUser($userID)
    {
        try {
            $appointments = Appointment::where('userID', $userID)->get();

            if ($appointments->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy cuộc hẹn nào cho userID này.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'appointments' => $appointments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy danh sách cuộc hẹn.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getCurrentAppointments($userID)
    {
        try {
            // Lấy 5 lịch khám gần nhất, sắp xếp theo ngày và giờ
            $appointments = Appointment::where('userID', $userID)
                ->whereDate('date', '<=', now()->format('Y-m-d')) // Lọc lịch khám từ hôm nay
                ->orderBy('date', 'asc') // Sắp xếp theo ngày tăng dần
                ->orderBy('time', 'asc') // Sắp xếp theo giờ tăng dần nếu cùng ngày
                ->limit(5) // Lấy tối đa 5 lịch khám
                ->get();

            if ($appointments->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy lịch khám sắp tới nào cho user này.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách lịch khám sắp tới thành công.',
                'appointments' => $appointments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy danh sách lịch khám sắp tới.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function cancelAppointment(Request $request, $userID, $appointmentID)
    {
        try {
            // Tìm lịch khám dựa trên userID và appointmentID
            $appointment = Appointment::where('userID', $userID)
                ->where('appointmentID', $appointmentID)
                ->first();

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy lịch khám.',
                ], 404);
            }

            // Cập nhật trạng thái thành "Cancelled"
            $appointment->status = 'Cancelled';
            $appointment->save();

            return response()->json([
                'success' => true,
                'message' => 'Lịch khám đã được hủy thành công.',
                'appointment' => $appointment,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể hủy lịch khám.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
