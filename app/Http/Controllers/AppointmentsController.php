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

    public function doctorLogin(Request $request)
    {
        try {
            // Step 1: Validate input
            $validator = Validator::make($request->all(), [
                'phone' => 'required|string',
                'password' => 'required|string',
            ], [
                'phone.required' => 'Số điện thoại không được để trống.',
                'password.required' => 'Mật khẩu không được để trống.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Step 2: Tìm bác sĩ bằng số điện thoại
            $doctor = Doctor::where('phone', $request->phone)->first();

            if (!$doctor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số điện thoại không tồn tại.',
                ], 404);
            }

            // Step 3: Xác minh mật khẩu
            if (!Hash::check($request->password, $doctor->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mật khẩu không đúng.',
                ], 401);
            }

            // Step 4: Tạo token nếu cần (Laravel Sanctum)
            $token = $doctor->createToken('authToken')->plainTextToken;

            // Step 5: Trả về phản hồi
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công.',
                'doctor' => $doctor,
                'token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
