@extends('frontend.layouts.master')
@section('title','Ecommerce Laravel || HOME PAGE')
@section('main-content')


  
<!-- Hero Section -->
<div class="hero">
        <h1>Your source for Multiple Solutions</h1>
        <ul>
            <li>Equipment repair and PM Service</li>
            <li>Guaranteed Cost Savings vs. OEM</li>
            <li>Support for "End of life" Equipment</li>
            <li>Replacement Equipment Available</li>
        </ul>
        <div class="button">
            <a href="#" class="cta-button">View Products</a>
        </div>
    </div>

<!-- Image Slider Section -->
<div class="splide" id="image-slider">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('css/img/image.png') }}" alt="Product 1"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/img2.jpg') }}" alt="Product 2"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/img3.jpg') }}" alt="Product 3"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/image.png') }}" alt="Product 4"></li>
        </ul>
    </div>
</div>

    <!-- Services Section -->
    <section class="services">
        <h2>What We Serve</h2>
        <div class="service-cards">
            <div class="service">
                <h3>Service 1</h3>
                <p>High-quality medical equipment for your needs.</p>
            </div>
            <div class="service">
                <h3>Service 2</h3>
                <p>Expert consultations and innovative solutions.</p>
            </div>
            <div class="service">
                <h3>Service 3</h3>
                <p>Reliable and certified products available anytime.</p>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="what-we-do">
        <h2>What We Do</h2>
        <div class="cards">
            <div class="card">
                <h3>Consulting</h3>
                <p>Helping you make the right choices.</p>
            </div>
            <div class="card">
                <h3>Sales</h3>
                <p>Supplying the best products in the market.</p>
            </div>
            <div class="card">
                <h3>Support</h3>
                <p>24/7 assistance for our valued customers.</p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="form-section">
        <h2>Get A Quote</h2>
        <form action="#" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" placeholder="Your Message"></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>
    <!-- New Image Slider Section -->
<div class="splide" id="secondary-slider">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('css/img/image5.jpg') }}" alt="Product 5"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/image6.jpg') }}" alt="Product 6"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/image7.jpg') }}" alt="Product 7"></li>
            <li class="splide__slide"><img src="{{ asset('css/img/image8.jpg') }}" alt="Product 8"></li>
        </ul>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                new Splide('#image-slider', {
                    type       : 'loop',       // Slider sẽ lặp lại
                    perPage    : 3,           // Số ảnh hiển thị cùng lúc
                    gap        : '1rem',      // Khoảng cách giữa các ảnh
                    autoplay   : true,        // Tự động chạy slider
                    interval   : 3000,        // Thời gian giữa mỗi ảnh (ms)
                    breakpoints: {
                        768: {
                            perPage: 2,      // Số ảnh hiển thị trên màn hình nhỏ
                        },
                        480: {
                            perPage: 1,      // Hiển thị 1 ảnh trên điện thoại
                        },
                    },
                }).mount();

                // Secondary Slider
                new Splide('#secondary-slider', {
                    type       : 'loop',
                    perPage    : 4,
                    gap        : '1rem',
                    autoplay   : false,
                    breakpoints: {
                        768: {
                            perPage: 2,
                        },
                        480: {
                            perPage: 1,
                        },
                    },
                }).mount();
            });
    </script>

@endpush
