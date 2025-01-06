<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GetdoctorsController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Xác thực thông tin
            $validator = Validator::make($request->all(), [
                'phoneNumber' => 'required|string',
                'password' => 'required|string',
            ], [
                'phoneNumber.required' => 'Số điện thoại không được để trống',
                'password.required' => 'Mật khẩu không được để trống'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Xác thực user
            if (!Auth::attempt(['phoneNumber' => $request->phoneNumber, 'password' => $request->password])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số điện thoại hoặc mật khẩu không đúng'
                ], 401);
            }

            // Lấy thông tin user
            $user = User::where('phoneNumber', $request->phoneNumber)->first();
            $token = $user->createToken('authToken')->plainTextToken;

            // Lọc danh sách bác sĩ theo province
            $province = $user->province; // Lấy tỉnh/thành phố của user
            $doctors = Doctor::where('location', 'like', "%$province%")->get(['doctorID', 'name', 'specialization', 'experience', 'working_hours', 'location', 'phone', 'email', 'photo']);

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'user' => $user,
                'province' => $province,
                'doctors' => $doctors, // Danh sách bác sĩ theo khu vực
                'token' => $token,
                'token_type' => 'Bearer'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
