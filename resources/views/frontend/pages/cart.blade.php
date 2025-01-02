@extends('frontend.layouts.master')

@section('title','Trang Thanh Toán')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết thúc Breadcrumbs -->

    <!-- Bắt đầu Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <form class="form" method="POST" action="{{route('cart.order')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Hoàn thành mua hàng</h2>
                            <p>Chỉ cần vài bước nữa để hoàn tất đơn hàng một cách an toàn!</p>
                            <!-- Biểu mẫu -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Họ<span>*</span></label>
                                        <input type="text" name="first_name" placeholder="" value="{{old('first_name')}}" required>
                                        @error('first_name')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Tên<span>*</span></label>
                                        <input type="text" name="last_name" placeholder="" value="{{old('last_name')}}" required>
                                        @error('last_name')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="email" name="email" placeholder="" value="{{old('email')}}" required>
                                        @error('email')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Số điện thoại<span>*</span></label>
                                        <input type="number" name="phone" placeholder="" value="{{old('phone')}}" required>
                                        @error('phone')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Địa chỉ 1<span>*</span></label>
                                        <input type="text" name="address1" placeholder="" value="{{old('address1')}}" required>
                                        @error('address1')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Địa chỉ 2</label>
                                        <input type="text" name="address2" placeholder="" value="{{old('address2')}}">
                                        @error('address2')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Mã bưu điện</label>
                                        <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                        @error('post_code')
                                            <span class='text-danger'>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--/ Kết thúc Biểu mẫu -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Chi tiết Đơn hàng -->
                            <div class="single-widget">
                                <h2>Tổng giỏ hàng</h2>
                                <div class="content">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Tạm tính
                                            <span>
                                                {{number_format(Helper::totalCartPrice(),0, ',', '.')}}đ
                                            </span>
                                        </li>
                                        <li class="shipping">
                                            Phí vận chuyển
                                            @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                <select name="shipping" class="nice-select" required>
                                                    <option value="">Chọn địa chỉ</option>
                                                    @foreach(Helper::shipping() as $shipping)
                                                    <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span>Miễn phí</span>
                                            @endif
                                        </li>
                                        @if(session('coupon'))
                                        <li class="coupon_price" data-price="{{session('coupon')['value']}}">Giảm giá<span>{{number_format(session('coupon')['value'],0, ',', '.')}} đ </span></li>
                                        @endif
                                        @php
                                            $total_amount=Helper::totalCartPrice();
                                            if(session('coupon')){
                                                $total_amount=$total_amount-session('coupon')['value'];
                                            }
                                        @endphp
                                        <li class="last"  id="order_total_price">Tổng cộng<span>{{number_format($total_amount,0, ',', '.')}} đ</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Kết thúc Chi tiết Đơn hàng -->
                            <!-- Phương thức Thanh toán -->
                            <div class="single-widget">
                                <h2>Phương thức thanh toán</h2>
                                <div class="content">
                                    <div class="checkbox">
                                        <form-group>
                                            <input name="payment_method"  type="radio" value="cod" required> <label> Thanh toán khi nhận hàng</label><br>
                                            <input name="payment_method"  type="radio" value="cardpay" required> <label> Thanh toán bằng thẻ</label><br>
                                            <div id="creditCardDetails" style="display: none;">
                                                <label for="cardNumber">Số thẻ:</label>
                                                <input type="text" id="cardNumber" name="card_number" maxlength="16"><br>
                                                <label for="cardName">Tên trên thẻ:</label>
                                                <input type="text" id="cardName" name="card_name"><br>
                                                <label for="expirationDate">Ngày hết hạn:</label>
                                                <input type="text" id="expirationDate" name="expiration_date" maxlength="5"><br>
                                                <label for="cvv">CVV:</label>
                                                <input type="text" id="cvv" name="cvv" maxlength="3"><br>
                                            </div>
                                        </form-group>
                                    </div>
                                </div>
                            </div>
                            <!-- Kết thúc Phương thức Thanh toán -->
                            <!-- Nút Thanh Toán -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" class="btn">Tiến hành thanh toán</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ Kết thúc Nút Thanh Toán -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ Kết thúc Checkout -->

    <!-- Bắt đầu Khu vực Dịch vụ -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Dịch vụ Đơn -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Miễn phí vận chuyển</h4>
                        <p>Đơn hàng trên $100</p>
                    </div>
                    <!-- Kết thúc Dịch vụ Đơn -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Dịch vụ Đơn -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Miễn phí trả lại</h4>
                        <p>Trong vòng 30 ngày</p>
                    </div>
                    <!-- Kết thúc Dịch vụ Đơn -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Dịch vụ Đơn -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Thanh toán an toàn</h4>
                        <p>100% bảo mật</p>
                    </div>
                    <!-- Kết thúc Dịch vụ Đơn -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Dịch vụ Đơn -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Giá tốt nhất</h4>
                        <p>Đảm bảo giá tốt</p>
                    </div>
                    <!-- Kết thúc Dịch vụ Đơn -->
                </div>
            </div>
        </div>
    </section>
    <!-- Kết thúc Khu vực Dịch vụ -->

@endsection
