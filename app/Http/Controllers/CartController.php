<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Str;
use Helper;

class CartController extends Controller
{
    protected $product = null;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function addToCart(Request $request)
    {
        if (empty($request->slug)) {
            request()->session()->flash('error', 'Sản phẩm không hợp lệ');
            return back();
        }

        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            request()->session()->flash('error', 'Sản phẩm không hợp lệ');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->where('product_id', $product->id)
            ->first();

        if ($already_cart) {
            // Tăng thêm số lượng
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount   = $product->price + $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) {
                return back()->with('error', 'Số lượng tồn kho không đủ!');
            }
            $already_cart->save();
        } else {
            // Tạo mới giỏ hàng
            $cart              = new Cart;
            $cart->user_id     = auth()->user()->id;
            $cart->product_id  = $product->id;
            $cart->price       = ($product->price - ($product->price * $product->discount) / 100);
            $cart->quantity    = 1;
            $cart->amount      = $cart->price * $cart->quantity;

            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) {
                return back()->with('error', 'Số lượng tồn kho không đủ!');
            }
            $cart->save();

            // Cập nhật wishlist (nếu có)
            $wishlist = Wishlist::where('user_id', auth()->user()->id)
                ->where('cart_id', null)
                ->update(['cart_id' => $cart->id]);
        }

        request()->session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng');
        return back();
    }

    /**
     * Thêm sản phẩm vào giỏ với số lượng xác định
     */
    public function singleAddToCart(Request $request)
    {
        $request->validate([
            'slug' => 'required',
            'quant' => 'required',
        ]);

        $product = Product::where('slug', $request->slug)->first();
        if ($product->stock < $request->quant[1]) {
            return back()->with('error', 'Hết hàng, bạn có thể thêm sản phẩm khác.');
        }

        if (($request->quant[1] < 1) || empty($product)) {
            request()->session()->flash('error', 'Sản phẩm không hợp lệ');
            return back();
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->where('product_id', $product->id)
            ->first();

        if ($already_cart) {
            // Tăng thêm số lượng
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            $already_cart->amount   = ($product->price * $request->quant[1]) + $already_cart->amount;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) {
                return back()->with('error', 'Số lượng tồn kho không đủ!');
            }
            $already_cart->save();
        } else {
            // Tạo mới giỏ hàng
            $cart             = new Cart;
            $cart->user_id    = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price      = ($product->price - ($product->price * $product->discount) / 100);
            $cart->quantity   = $request->quant[1];
            $cart->amount     = ($product->price * $request->quant[1]);

            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) {
                return back()->with('error', 'Số lượng tồn kho không đủ!');
            }
            $cart->save();
        }

        request()->session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        return back();
    }

    /**
     * Xóa một mục trong giỏ hàng
     */
    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
            return back();
        }
        request()->session()->flash('error', 'Đã xảy ra lỗi, vui lòng thử lại');
        return back();
    }

    /**
     * Cập nhật giỏ hàng
     */
    public function cartUpdate(Request $request)
    {
        if ($request->quant) {
            $error   = [];
            $success = '';

            foreach ($request->quant as $k => $quant) {
                $id   = $request->qty_id[$k];
                $cart = Cart::find($id);

                if ($quant > 0 && $cart) {
                    // Kiểm tra tồn kho
                    if ($cart->product->stock < $quant) {
                        request()->session()->flash('error', 'Hết hàng');
                        return back();
                    }

                    // Cập nhật số lượng (không vượt quá tồn kho)
                    $cart->quantity = ($cart->product->stock > $quant) ? $quant : $cart->product->stock;
                    if ($cart->product->stock <= 0) continue;

                    // Tính lại giá tiền
                    $after_price = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $cart->amount = $after_price * $cart->quantity;
                    $cart->save();

                    $success = 'Cập nhật giỏ hàng thành công!';
                } else {
                    $error[] = 'Giỏ hàng không hợp lệ!';
                }
            }
            return back()->with($error)->with('success', $success);
        } else {
            return back()->with('Giỏ hàng không hợp lệ!');
        }
    }

    /**
     * Trang checkout
     */
    public function checkout(Request $request)
    {
        return view('frontend.pages.checkout');
    }


    // API
    public function getUserCart($userID)
    {
        try {
            // Lấy thông tin giỏ hàng của user
            $cartItems = Cart::with('product') // Lấy thông tin sản phẩm
                ->where('user_id', $userID)
                ->whereNull('order_id') // Chỉ lấy các sản phẩm chưa được đặt hàng
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng trống.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Lấy giỏ hàng thành công.',
                'cart' => $cartItems,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể lấy giỏ hàng.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
