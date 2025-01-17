<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use Illuminate\Contracts\View\View as ViewContract;
use App\Models\Appointment;
use App\Rules\MatchOldPassword;
use App\Models\Doctor;
use Illuminate\Support\Facades\Log;


class DoctorsController extends Controller
{
    /**
     * Áp dụng middleware auth để đảm bảo chỉ user đã đăng nhập mới truy cập được
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Trang index cho bác sĩ
     */
    public function index()
    {
        return view('doctor.index');
    }

    public function showDoctorDetail($id)
    {
        $doctor = Doctor::find($id);
    
        if (!$doctor) {
            return redirect()->back()->with('error', 'Bác sĩ không tồn tại.');
        }
    
        return view('frontend.pages.doctor_detail', compact('doctor'));
    }
    
    
    /**
     * Trang hồ sơ (profile) của bác sĩ
     */
    public function profile()
    {
        $profile = auth()->user();
        return view('doctor.users.profile')->with('profile', $profile);
    }

    /**
     * Cập nhật hồ sơ (profile) của bác sĩ
     */
    public function profileUpdate(Request $request, $id)
    {
        $user   = User::findOrFail($id);
        $data   = $request->all();
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật thông tin thành công');
        } else {
            request()->session()->flash('error', 'Vui lòng thử lại!');
        }
        return redirect()->back();
    }

    /**
     * Danh sách đơn hàng của bác sĩ (orderIndex)
     */
    public function orderIndex()
    {
        $orders = Order::orderBy('id', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);
        return view('doctor.order.index')->with('orders', $orders);
    }

    /**
     * Xóa đơn hàng (doctorOrderDelete)
     */
    public function doctorOrderDelete($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->status == "process" || $order->status == 'delivered' || $order->status == 'cancel') {
                return redirect()->back()->with('error', 'Bạn không thể xóa đơn hàng này vào lúc này');
            } else {
                $status = $order->delete();
                if ($status) {
                    request()->session()->flash('success', 'Đã xóa đơn hàng thành công');
                } else {
                    request()->session()->flash('error', 'Không thể xóa đơn hàng, vui lòng thử lại');
                }
                return redirect()->route('doctor.order.index');
            }
        } else {
            request()->session()->flash('error', 'Không tìm thấy đơn hàng');
            return redirect()->back();
        }
    }

    /**
     * Xem chi tiết đơn hàng (orderShow)
     */
    public function orderShow($id)
    {
        $order = Order::find($id);
        return view('doctor.order.show')->with('order', $order);
    }

    /**
     * Danh sách đánh giá sản phẩm (productReviewIndex)
     */
    public function productReviewIndex()
    {
        $reviews = ProductReview::getAllUserReview();
        return view('doctor.review.index')->with('reviews', $reviews);
    }

    /** 
     * Trang chỉnh sửa đánh giá sản phẩm (productReviewEdit)
     */
    public function productReviewEdit($id)
    {
        $review = ProductReview::find($id);
        return view('doctor.review.edit')->with('review', $review);
    }

    /**
     * Cập nhật đánh giá sản phẩm (productReviewUpdate)
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review = ProductReview::find($id);
        if ($review) {
            $data   = $request->all();
            $status = $review->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'Cập nhật đánh giá thành công');
            } else {
                request()->session()->flash('error', 'Đã xảy ra lỗi! Vui lòng thử lại!');
            }
        } else {
            request()->session()->flash('error', 'Không tìm thấy đánh giá!');
        }

        return redirect()->route('doctor.productreview.index');
    }

    /**
     * Xóa đánh giá sản phẩm (productReviewDelete)
     */
    public function productReviewDelete($id)
    {
        $review = ProductReview::find($id);
        $status = $review->delete();
        if ($status) {
            request()->session()->flash('success', 'Xóa đánh giá thành công');
        } else {
            request()->session()->flash('error', 'Đã xảy ra lỗi! Vui lòng thử lại');
        }
        return redirect()->route('doctor.productreview.index');
    }

    /**
     * Danh sách bình luận bài viết (doctorComment)
     */
    public function doctorComment()
    {
        $comments = PostComment::getAllUserComments();
        return view('doctor.comment.index')->with('comments', $comments);
    }

    /**
     * Xóa bình luận bài viết (doctorCommentDelete)
     */
    public function doctorCommentDelete($id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $status = $comment->delete();
            if ($status) {
                request()->session()->flash('success', 'Đã xóa bình luận bài viết');
            } else {
                request()->session()->flash('error', 'Đã xảy ra lỗi, vui lòng thử lại');
            }
            return back();
        } else {
            request()->session()->flash('error', 'Không tìm thấy bình luận bài viết');
            return redirect()->back();
        }
    }

    /**
     * Trang chỉnh sửa bình luận bài viết (doctorCommentEdit)
     */
    public function doctorCommentEdit($id)
    {
        $comments = PostComment::find($id);
        if ($comments) {
            return view('doctor.comment.edit')->with('comment', $comments);
        } else {
            request()->session()->flash('error', 'Không tìm thấy bình luận');
            return redirect()->back();
        }
    }

    /**
     * Cập nhật bình luận bài viết (doctorCommentUpdate)
     */
    public function doctorCommentUpdate(Request $request, $id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $data   = $request->all();
            $status = $comment->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'Cập nhật bình luận thành công');
            } else {
                request()->session()->flash('error', 'Đã xảy ra lỗi! Vui lòng thử lại!');
            }
            return redirect()->route('doctor.post-comment.index');
        } else {
            request()->session()->flash('error', 'Không tìm thấy bình luận');
            return redirect()->back();
        }
    }

    /**
     * Trang đổi mật khẩu cho bác sĩ
     */
    public function changePassword()
    {
        return view('doctor.layouts.doctorPasswordChange');
    }

    /**
     * Lưu mật khẩu mới (changPasswordStore)
     */
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('doctor')->with('success', 'Đổi mật khẩu thành công');
    }




    //Get doctors API
    public function apigetAllDoctors(Request $request)
    {
        try {
            $doctors = Doctor::all(); // Lấy tất cả bác sĩ

            return response()->json([
                'success' => true,
                'doctors' => $doctors,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error in fetching doctors: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy danh sách bác sĩ.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function apigetDoctorsByDoctorId($doctorID)
    {
        try {
            $doctors = Doctor::where('doctorID', $doctorID)->get();

            if ($doctors->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => "Không tìm thấy bác sĩ nào cho ID {$doctorID}.",
                ], 404);
            }

            return response()->json([
                'success' => true,
                'doctors' => $doctors,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy thông tin bác sĩ.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
