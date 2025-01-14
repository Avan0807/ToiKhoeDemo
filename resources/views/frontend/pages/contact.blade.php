@extends('frontend.layouts.master')

@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Kết thúc Breadcrumbs -->

	<!-- Bắt đầu Liên hệ -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									@php
										$settings=DB::table('settings')->get();
									@endphp
									<h4>Liên hệ với chúng tôi</h4>
									<h3>Gửi tin nhắn cho chúng tôi 
										@auth 
										@else
										<span style="font-size:12px;" class="text-danger">[Bạn cần đăng nhập trước]</span>
										@endauth
									</h3>
								</div>
								<form class="form-contact form contact_form" method="post" action="{{route('contact.store')}}" id="contactForm" novalidate="novalidate">
									@csrf
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tên của bạn<span>*</span></label>
												<input name="name" id="name" type="text" placeholder="Nhập tên của bạn">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Chủ đề<span>*</span></label>
												<input name="subject" type="text" id="subject" placeholder="Nhập chủ đề">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Email của bạn<span>*</span></label>
												<input name="email" type="email" id="email" placeholder="Nhập địa chỉ email">
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Số điện thoại<span>*</span></label>
												<input id="phone" name="phone" type="number" placeholder="Nhập số điện thoại của bạn">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>Tin nhắn của bạn<span>*</span></label>
												<textarea name="message" id="message" cols="30" rows="9" placeholder="Nhập tin nhắn"></textarea>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn">Gửi tin nhắn</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">Gọi ngay:</h4>
									<ul>
										<li>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">Email:</h4>
									<ul>
										<li><a href="mailto:info@yourwebsite.com">@foreach($settings as $data) {{$data->email}} @endforeach</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">Địa chỉ của chúng tôi:</h4>
									<ul>
										<li>@foreach($settings as $data) {{$data->address}} @endforeach</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ Kết thúc Liên hệ -->

	<!-- Phần Bản đồ -->
	<div class="map-section">
		<div id="myMap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.471423893917!2d105.79926287606676!3d21.013815080631726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab14e737e89b%3A0x29ffe100f3c73899!2sTrung%20Yen%20Plaza!5e0!3m2!1svi!2s!4v1715790099186!5m2!1svi!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		</div>
	</div>
	<!--/ Kết thúc Phần Bản đồ -->

	<!-- Bắt đầu Newsletter -->
	@include('frontend.layouts.newsletter')
	<!-- Kết thúc Newsletter -->
	
	<!--================Thành công khi liên hệ =================-->
	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
				<h2 class="text-success">Cảm ơn bạn!</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-success">Tin nhắn của bạn đã được gửi thành công...</p>
			</div>
		  </div>
		</div>
	</div>

	<!-- Thông báo lỗi -->
	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
				<h2 class="text-warning">Xin lỗi!</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-warning">Đã xảy ra lỗi.</p>
			</div>
		  </div>
		</div>
	</div>
@endsection

@push('styles')
<style>
	.modal-dialog .modal-content .modal-header{
		position:initial;
		padding: 10px 20px;
		border-bottom: 1px solid #e9ecef;
	}
	.modal-dialog .modal-content .modal-body{
		height:100px;
		padding:10px 20px;
	}
	.modal-dialog .modal-content {
		width: 50%;
		border-radius: 0;
		margin: auto;
	}
</style>
@endpush

@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush
