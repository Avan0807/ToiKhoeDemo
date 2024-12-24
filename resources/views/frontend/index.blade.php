@extends('frontend.layouts.master')
@section('title','Ecommerce Laravel || HOME PAGE')
@section('main-content')


<!-- Hero Section -->
<!-- <div class="hero">
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
    </div> -->

<!-- Hero Section -->
<div class="hero">
    <div class="banner-left">
        <!-- Left banner content (if any) -->
    </div>
    <div class="banner-right">
        <div class="banner-top">
            <!-- Top-right banner content (if any) -->
        </div>
        <div class="banner-bottom">
            <!-- Bottom-right banner content (if any) -->
        </div>
    </div>
</div>


<!-- Image Slider Section -->
<div class="splide" id="image-slider">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('files/1/image.png') }}" alt="Product 1"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/img2.jpg') }}" alt="Product 2"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/img3.jpg') }}" alt="Product 3"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/image.png') }}" alt="Product 4"></li>
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
<!-- New Image Slider Section -->
<div class="splide" id="secondary-slider">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide"><img src="{{ asset('files/1/image.png') }}" alt="Product 5"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/img2.jpg') }}" alt="Product 6"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/img3.jpg') }}" alt="Product 7"></li>
            <li class="splide__slide"><img src="{{ asset('files/1/image.png') }}" alt="Product 8"></li>
        </ul>
    </div>
</div>


<!-- Shop By Product Section -->
<div class="product-section">
    <!-- Left Column -->
    <div class="left-column">
        <section class="top-sale">
            <h2>Top Sale in Day</h2>
            <div class="product-grid">
                <!-- Sản phẩm Top Sale -->
                @for ($i = 0; $i < 6; $i++)
                    <div class="product-card">
                    <img src="{{ asset('files/products/product.jpg') }}" alt="Product {{ $i + 1 }}">
                    <h3>Product {{ $i + 1 }}</h3>
                    <p>$80.00</p>
                    <button>Add to Cart</button>
            </div>
            @endfor
    </div>
    </section>

    <section class="best-seller">
        <h2>Best Seller</h2>
        <div class="product-grid">
            <!-- Sản phẩm Best Seller -->
            @for ($i = 0; $i < 6; $i++)
                <div class="product-card">
                <img src="{{ asset('files/products/best-seller.jpg') }}" alt="Best Seller {{ $i + 1 }}">
                <h3>Best Seller {{ $i + 1 }}</h3>
                <p>$100.00</p>
                <button>Add to Cart</button>
        </div>
        @endfor

    <section class="small-banner">
        <div class="small-banner-left">

        </div>
        <div class="small-banner-right">
            
        </div>
    </section>
</div>
</section>
</div>

<!-- Right Column -->
<div class="right-column">
    <section class="categories">
        <h2>Shop By Category</h2>
        <ul>
            <li><a href="#">Category 1</a></li>
            <li><a href="#">Category 2</a></li>
            <li><a href="#">Category 3</a></li>
            <li><a href="#">Category 4</a></li>
        </ul>
    </section>

    <section class="newest-product">
        <h2>Newest Product</h2>
        <img src="{{ asset('files/products/new-product.jpg') }}" alt="Newest Product">
    </section>

    <section class="shop-by-product">
        <h3>Shop By Product</h3>
        <ul>
            <li><a href="#">Decorations</a></li>
            <li><a href="#">Bed Linen</a></li>
            <li><a href="#">Cushions</a></li>
            <li><a href="#">Blankets</a></li>
            <li><a href="#">Giftwraps</a></li>
            <li><a href="#">Sleepwear</a></li>
            <li><a href="#">Cookware & Bakeware</a></li>
            <li><a href="#">Room Fragrance</a></li>
            <li><a href="#">Bath & Shower</a></li>
        </ul>
    </section>
</div>
</div>

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

<section class="blog-section">
    <h2>Health News</h2>
    <div class="blog-container">
        <!-- Newest Blog -->
        <div class="newest-blog">
            <img src="{{ asset('files/blogs/newest-blog.jpg') }}" alt="Newest Blog">
            <h3>Newest Blog Title</h3>
            <p>Short description of the newest blog goes here...</p>
            <a href="#" class="read-more">Read More</a>
        </div>

        <!-- Other Blogs -->
        <div class="other-blogs">
            <div class="blog-card">
                <h4>Blog 1</h4>
                <p>Brief description of Blog 1...</p>
                <a href="#">Read More</a>
            </div>
            <div class="blog-card">
                <h4>Blog 2</h4>
                <p>Brief description of Blog 2...</p>
                <a href="#">Read More</a>
            </div>
            <div class="blog-card">
                <h4>Blog 3</h4>
                <p>Brief description of Blog 3...</p>
                <a href="#">Read More</a>
            </div>
        </div>
    </div>
</section>





@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#image-slider', {
            type: 'loop', // Slider sẽ lặp lại
            perPage: 4, // Số ảnh hiển thị cùng lúc
            gap: '1rem', // Khoảng cách giữa các ảnh
            autoplay: true, // Tự động chạy slider
            interval: 3000, // Thời gian giữa mỗi ảnh (ms)
            breakpoints: {
                768: {
                    perPage: 2, // Số ảnh hiển thị trên màn hình nhỏ
                },
                480: {
                    perPage: 1, // Hiển thị 1 ảnh trên điện thoại
                },
            },
        }).mount();

        // Secondary Slider
        new Splide('#secondary-slider', {
            type: 'loop',
            perPage: 4,
            gap: '1rem',
            autoplay: false,
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