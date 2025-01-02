@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="mua sắm trực tuyến, mua hàng, giỏ hàng, trang thương mại điện tử, mua sắm trực tuyến tốt nhất">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection

@section('title','Ecommerce Laravel || Chi Tiết Sản Phẩm')

@section('main-content')

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="">Chi Tiết Sản Phẩm</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kết thúc Breadcrumbs -->

		<!-- Chi Tiết Sản Phẩm -->
		<section class="shop single section">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-lg-6 col-12">
										<!-- Slider Sản Phẩm -->
										<div class="product-gallery">
											<!-- Ảnh slider -->
											<div class="flexslider-thumbnails">
												<ul class="slides">
													@php
														$photo=explode(',',$product_detail->photo);
													@endphp
													@foreach($photo as $data)
														<li data-thumb="{{$data}}" rel="adjustX:10, adjustY:">
															<img src="{{$data}}" alt="{{$data}}">
														</li>
													@endforeach
												</ul>
											</div>
											<!-- Kết thúc Ảnh slider -->
										</div>
										<!-- Kết thúc Slider -->
									</div>
									<div class="col-lg-6 col-12">
										<div class="product-des">
											<!-- Mô Tả -->
											<div class="short">
												<h4>{{$product_detail->title}}</h4>
												<div class="rating-main">
													<ul class="rating">
														@php
															$rate=ceil($product_detail->getReview->avg('rate'))
														@endphp
															@for($i=1; $i<=5; $i++)
																@if($rate>=$i)
																	<li><i class="fa fa-star"></i></li>
																@else
																	<li><i class="fa fa-star-o"></i></li>
																@endif
															@endfor
													</ul>
													<a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Đánh giá</a>
                                                </div>
                                                @php
                                                    $after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
                                                @endphp
												<p class="price"><span class="discount">{{number_format($after_discount,2)}} đ</span><s>{{number_format($product_detail->price,2)}} đ</s></p>
												<p class="description">{!!($product_detail->summary)!!}</p>
											</div>
											<!-- Kết thúc Mô Tả -->

											<!-- Chọn Size -->
											@if($product_detail->size)
												<div class="size mt-4">
													<h4>Kích cỡ</h4>
													<ul>
														@php
															$sizes=explode(',',$product_detail->size);
														@endphp
														@foreach($sizes as $size)
														<li><a href="#" class="one">{{$size}}</a></li>
														@endforeach
													</ul>
												</div>
											@endif
											<!-- Kết thúc Chọn Size -->

											<!-- Mua Sản Phẩm -->
											<div class="product-buy">
												<form action="{{route('single-add-to-cart')}}" method="POST">
													@csrf
													<div class="quantity">
														<h6>Số lượng :</h6>
														<!-- Chọn số lượng -->
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="hidden" name="slug" value="{{$product_detail->slug}}">
															<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
													<!-- Kết thúc Chọn số lượng -->
													</div>
													<div class="add-to-cart mt-4">
														<button type="submit" class="btn">Thêm vào giỏ</button>
														<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a>
													</div>
												</form>

												<p class="cat">Danh mục :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
												@if($product_detail->sub_cat_info)
												<p class="cat mt-1">Danh mục con :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
												@endif
												<p class="availability"> Trạng thái:
    @if($product_detail->stock > 0)
        @if($product_detail->stock < 5)
            <span class="badge badge-warning">Còn ít</span>
        @else
            <span class="badge badge-success">Còn hàng</span>
        @endif
    @else
        <span class="badge badge-danger">Hết hàng</span>
    @endif
</p>
											</div>
											<!-- Kết thúc Mua Sản Phẩm -->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!-- Kết thúc Chi Tiết Sản Phẩm -->

		<!-- Sản Phẩm Liên Quan -->
	<div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Sản Phẩm Liên Quan</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach($product_detail->rel_prods as $data)
                            @if($data->id !==$product_detail->id)
                                <!-- Bắt đầu sản phẩm -->
                                <div class="single-product">
                                    <div class="product-img">
										<a href="{{route('product-detail',$data->slug)}}">
											@php
												$photo=explode(',',$data->photo);
											@endphp
                                            <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                            <span class="price-dec">{{$data->discount}} % Giảm</span>
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
                                        <div class="product-price">
                                            @php
                                                $after_discount=($data->price-(($data->discount*$data->price)/100));
                                            @endphp
                                            <span class="old">{{number_format($data->price,2)}} đ</span>
                                            <span>{{number_format($after_discount,2)}} đ</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Kết thúc sản phẩm -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Kết thúc Sản Phẩm Liên Quan -->

@endsection
