<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle user login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Step 1: Validate input
            $validator = Validator::make($request->all(), [
                'phoneNumber' => 'required|string',
                'password' => 'required|string',
            ], [
                'phoneNumber.required' => 'Số điện thoại không được để trống',
                'password.required' => 'Mật khẩu không được để trống',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Step 2: Authenticate user
            if (!Auth::attempt(['phoneNumber' => $request->phoneNumber, 'password' => $request->password])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số điện thoại hoặc mật khẩu không đúng',
                ], 401);
            }

            // Step 3: Retrieve authenticated user
            $user = Auth::user();

            // Step 4: Generate Sanctum token
            $token = $user->createToken('authToken')->plainTextToken;

            // Step 5: Return response
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle user logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Delete current access token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công',
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'Đăng xuất thất bại',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
