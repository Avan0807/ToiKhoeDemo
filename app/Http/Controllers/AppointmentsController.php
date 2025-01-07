<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentsController extends Controller
{
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
}
