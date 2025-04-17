@extends('layouts.client.Master')
@section('title')
    Trang chủ
@endsection

@section('content')
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    {{-- Banner --}}
    <div class="banner">
        <img class="w-full object-cover" src="{{ asset('images/banner-home.webp') }}" alt="">
    </div>

    {{-- Service --}}
    <div class="content responsive">
        <div class="service grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-6 gap-x-2">
            <div class="flex items-center  lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_1.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Miễn phí giao hàng</p>
                    <p class="text-[12px] text-[#888888]">Miễn phí ship với đơn hàng > 498K</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_2.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Thanh toán COD</p>
                    <p class="text-[12px] text-[#888888]">Thanh toán khi nhận hàng (COD)</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_3.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Khách hàng VIP</p>
                    <p class="text-[12px] text-[#888888]">Ưu đãi dành cho khách hàng VIP</p>
                </div>
            </div>

            <div class="flex items-center lg:justify-center lg:gap-3 sm:gap-2 gap-4">
                <img class="w-10" src="{{ asset('images/service_4.webp') }}" alt="">
                <div>
                    <p class="font-semibold text-[14px]">Hỗ trợ bảo hành</p>
                    <p class="text-[12px] text-[#888888]">Đổi, sửa đồ tại tất cả store</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Mẫu mới về --}}
    <div class="new-product responsive">
        <h2 class="sub-title">Mẫu mới về</h2>

        <div
            class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-3 lg:gap-x-5">
            @foreach ($latestProducts as $product)
                <div
                    class="slide-up-effect relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg">
                    <!-- Discount badge -->
                    <span
                        class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                        -{{ $product->discount }}%
                    </span>

                    <!-- Product image -->
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <div class="relative overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/images/products/' . $product->product_image->image) }}"
                                alt="{{ $product->name }}" class="w-full h-60 object-cover rounded-t-md">

                            <!-- Wishlist button with tooltip -->
                            <button
                                class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full shadow-md group/button">
                                <span class="material-symbols-rounded icon-heart">
                                    favorite
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="tooltip-text absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 delay-100 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Yêu thích
                                </span>
                            </button>

                            <!-- Add to cart button with tooltip -->
                            <button
                                class="absolute bottom-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full transition-all shadow-md group/button">
                                <span class="material-symbols-rounded">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>
                    </a>

                    <!-- Product details -->
                    <div class="md:px-4 md:py-2 p-2">
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                {{ $product->name }}
                            </p>
                        </a>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <p class="text-orangeColor font-semibold text-[14px]">
                                    {{ number_format($product->default_price - ($product->default_price * $product->discount) / 100, 0, ',', '.') }}đ
                                </p>
                                <p class="text-gray-400 line-through text-[12px]">
                                    {{ number_format($product->default_price, 0, ',', '.') }}đ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Promo banner --}}
    <div
        class="promo-banner lg:w-10/12 md:w-11/12 mx-auto grid sm:grid-cols-2 grid-cols-1 lg:mt-10 mt-6 gap-4 sm:gap-5 overflow-hidden px-4 hidden-promo-banner">
        <div class="w-full ">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner1.webp') }}" alt="">
        </div>
        <div class="w-full  grid grid-cols-2 grid-rows-[auto_auto] gap-4 sm:gap-5">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner2.webp') }}" alt="">
            <img class="w-full object-cover rounded-lg" src="{{ asset('images/promo-banner3.webp') }}" alt="">
            <img class="w-full object-cover col-span-2 rounded-lg" src="{{ asset('images/promo-banner4.webp') }}"
                alt="">
        </div>
    </div>

    {{-- Được ưa chuộng --}}
    <div class="sale-product responsive mt-8">
        <h2 class="sub-title">Được ưa chuộng</h2>

        <div
            class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-3 lg:gap-x-5">
            @foreach ($mostFavoritedProducts as $product)
                <div
                    class="slide-up-effect relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg">
                    <!-- Discount badge -->
                    <span
                        class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                        -{{ $product->discount }}%
                    </span>

                    <!-- Product image -->
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <div class="relative overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/images/products/' . $product->product_image->image) }}"
                                alt="{{ $product->name }}" class="w-full h-60 object-cover rounded-t-md">

                            <!-- Wishlist button with tooltip -->
                            <button
                                class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full shadow-md group/button">
                                <span class="material-symbols-rounded icon-heart">
                                    favorite
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="tooltip-text absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 delay-100 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Yêu thích
                                </span>
                            </button>

                            <!-- Add to cart button with tooltip -->
                            <button
                                class="absolute bottom-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full transition-all shadow-md group/button">
                                <span class="material-symbols-rounded">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>
                    </a>

                    <!-- Product details -->
                    <div class="md:px-4 md:py-2 p-2">
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                {{ $product->name }}
                            </p>
                        </a>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <p class="text-orangeColor font-semibold text-[14px]">
                                    {{ number_format($product->default_price - ($product->default_price * $product->discount) / 100, 0, ',', '.') }}đ
                                </p>
                                <p class="text-gray-400 line-through text-[12px]">
                                    {{ number_format($product->default_price, 0, ',', '.') }}đ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Notification Bar --}}
    <div class="notification-bar responsive">
        <div class="w-full py-5 px-5 rounded bg-redColor flex items-center justify-center text-white text-lg relative">
            <div id="promo-text" class="text-justify transition-opacity duration-500 opacity-100">
                HOT: Sale 50% cho toàn bộ đơn hàng có giá trị từ 2 triệu, miễn phí ship toàn quốc
            </div>
        </div>
    </div>

    {{-- Top bán chạy --}}
    <div class="sale-product responsive ">
        <h2 class="sub-title">Top bán chạy</h2>

        <div
            class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 sm:gap-4 md:gap-x-3 lg:gap-x-5">
            @foreach ($bestSellingProducts as $product)
                <div
                    class="slide-up-effect relative bg-white shadow-md rounded-md overflow-hidden transition-all duration-300 group hover:scale-[1.02] hover:-translate-y-1 hover:shadow-lg">
                    <!-- Discount badge -->
                    <span
                        class="absolute top-2 left-2 bg-redColor text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md z-10 animate-pulse">
                        -{{ $product->discount }}%
                    </span>

                    <!-- Product image -->
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <div class="relative overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/images/products/' . $product->product_image->image) }}"
                                alt="{{ $product->name }}" class="w-full h-60 object-cover rounded-t-md">

                            <!-- Wishlist button with tooltip -->
                            <button
                                class="wishlist-btn absolute top-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full shadow-md group/button">
                                <span class="material-symbols-rounded icon-heart">
                                    favorite
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="tooltip-text absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 delay-100 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Yêu thích
                                </span>
                            </button>

                            <!-- Add to cart button with tooltip -->
                            <button
                                class="absolute bottom-1 right-1 w-10 h-10 bg-white text-orangeColor flex items-center justify-center rounded-full transition-all shadow-md group/button">
                                <span class="material-symbols-rounded">
                                    add_shopping_cart
                                </span>

                                <!-- Tooltip -->
                                <span
                                    class="absolute right-full mr-1 px-3 py-1.5 text-xs font-medium text-white bg-gray-800 rounded-lg text-nowrap opacity-0 translate-x-2 transition-all duration-300 md:group-hover/button:opacity-100 md:group-hover/button:translate-x-0">
                                    Thêm vào giỏ hàng
                                </span>
                            </button>
                        </div>
                    </a>

                    <!-- Product details -->
                    <div class="md:px-4 md:py-2 p-2">
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <p
                                class="text-gray-800 md:text-md sm:text-md text-[16px] mb-1 line-clamp-2 overflow-hidden text-ellipsis min-h-[3.2em] hover:text-orangeColor">
                                {{ $product->name }}
                            </p>
                        </a>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <p class="text-orangeColor font-semibold text-[14px]">
                                    {{ number_format($product->default_price - ($product->default_price * $product->discount) / 100, 0, ',', '.') }}đ
                                </p>
                                <p class="text-gray-400 line-through text-[12px]">
                                    {{ number_format($product->default_price, 0, ',', '.') }}đ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Banner phụ --}}
    <div class="sub-banner responsive">
        <img class="w-full rounded object-cover" src="{{ asset('images/sub-banner-home.png') }}" alt="">
    </div>

    {{-- Từ khóa hot --}}
    <div class="responsive">
        <div class="flex gap-6 md:flex-row flex-col">
            <h2 class="uppercase text-[28px] tracking-widest text-nowrap">Từ khóa hot</h2>
            <div class="flex flex-wrap gap-3">
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo Polo
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo khoác da
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo chống nắng
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Chân váy
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo sơ mi
                </div>
                <div
                    class="group cursor-pointer relative inline-block overflow-hidden rounded border border-gray-100 bg-orangeColor px-6 py-3 text-sm font-medium text-white hover:text-orangeColor hover:bg-white focus:outline-none focus:ring active:bg-orangeColor active:text-white">
                    <span
                        class="ease absolute left-0 top-0 h-0 w-0 border-t-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute right-0 top-0 h-0 w-0 border-r-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 right-0 h-0 w-0 border-b-2 border-orangeColor transition-all duration-200 group-hover:w-full">
                    </span>
                    <span
                        class="ease absolute bottom-0 left-0 h-0 w-0 border-l-2 border-orangeColor transition-all duration-200 group-hover:h-full">
                    </span>
                    Áo thun nữ
                </div>
            </div>
        </div>
    </div>

    {{-- Tin tức mới nhất --}}
    <div class="responsive mt-6 ">
        <h2 class="uppercase text-[28px] tracking-widest text-nowrap text-center">Tin tức mới nhất</h2>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 mt-6 justify-between md:slide-up-effect">
            {{-- Tin đầu tiên - nổi bật --}}
            @if ($latestNews->isNotEmpty())
                @php $firstNews = $latestNews->first(); @endphp
                <div class="slide-up-effect">
                    <div class="overflow-hidden">
                        <img class="aspect-[4/3] object-cover hover:scale-110 duration-500 cursor-pointer"
                            src="{{ asset('storage/images/news/' . $firstNews->thumbnail) }}"
                            alt="{{ $firstNews->title }}">
                    </div>
                    <p class="my-2 text-[#888888] text-sm">{{ $firstNews->created_at->format('d/m/Y') }}</p>
                    <h3
                        class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                        {{ $firstNews->title }}
                    </h3>
                    <p class="text-[#888888] text-sm line-clamp-2">
                        {{ $firstNews->excerpt }}
                    </p>
                </div>
            @endif

            <div class="md:flex flex-col gap-4 block">
                @foreach ($latestNews->skip(1) as $news)
                    <div class="md:flex gap-2 md:mt-0 mt-8 slide-up-effect">
                        <div class="overflow-hidden min-w-[200px]">
                            <img class="aspect-[4/3] md:w-[200px] object-cover hover:scale-110 duration-500 cursor-pointer"
                                src="{{ asset('storage/images/news/' . $news->thumbnail) }}" alt="">
                        </div>
                        <div>
                            <p class="mb-2 text-[#888888] text-sm">{{ $news->created_at->format('d/m/Y') }}</p>
                            <h3
                                class="md:text-[16px] lg:text-lg md:line-clamp-2 hover:text-orangeColor cursor-pointer mb-2 font-semibold text-[18px]">
                                {{ $news->title }}
                            </h3>
                            <p class="text-[#888888] text-sm line-clamp-2">
                                {{ $news->excerpt }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Slider infinite --}}
    <div class="w-full overflow-hidden whitespace-nowrap bg-redColor py-4 mb-6">
        <div class="inline-block animate-marquee">
            <span class="text-white text-2xl font-bold mx-8">🔥 Sản phẩm mới nhất!</span>
            <span class="text-white text-2xl font-bold mx-8">🚀 Giảm giá sốc!</span>
            <span class="text-white text-2xl font-bold mx-8">💥 Mua ngay kẻo lỡ!</span>
            <span class="text-white text-2xl font-bold mx-8">🎉 Freeship toàn quốc!</span>
        </div>
    </div>

    <script>
        // Promo banner
        const messages = [
            "🔥Mua 1 tặng 1 cho tất cả sản phẩm mới!",
            "🚀Free ship toàn quốc cho đơn hàng từ 500K!",
            "🎉Giảm ngay 100K cho đơn hàng đầu tiên!",
        ];

        let index = 0;
        const promoText = document.getElementById("promo-text");

        function changeText() {
            promoText.style.opacity = 0; // Ẩn chữ cũ
            setTimeout(() => {
                index++;
                if (index >= messages.length) {
                    index = 0;
                }
                promoText.innerText = messages[index];
                promoText.style.opacity = 1;
            }, 500);
        }

        setInterval(changeText, 3000);
    </script>
@endsection
