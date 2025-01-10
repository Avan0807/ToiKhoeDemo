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
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'doctorID' => 'required|exists:Doctors,doctorID',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'consultation_type' => 'required|in:Online,Offline',
            'note' => 'nullable|string',
            'status' => 'nullable|in:Pending,Approved,Cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Kiểm tra userID có tồn tại không
            $userExists = User::where('id', $userID)->exists();
            if (!$userExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'User không tồn tại.',
                ], 404);
            }

            // Tạo lịch khám
            $appointment = Appointment::create([
                'userID' => $userID,
                'doctorID' => $request->doctorID,
                'date' => $request->date,
                'time' => $request->time,
                'consultation_type' => $request->consultation_type,
                'note' => $request->note,
                'status' => $request->status ?? 'Scheduled',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lịch khám đã được tạo thành công.',
                'appointment' => $appointment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể tạo lịch khám.',
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
}
